<?php		
	namespace MVC\Command;	
	class ReportDailyCollect extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack 	= $request->getProperty('IdTrack');
			$IdTD 		= $request->getProperty('IdTD');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCollectGeneral= new \MVC\Mapper\CollectGeneral();
			$mCollectCustomer= new \MVC\Mapper\CollectCustomer();
			$mTracking 		= new \MVC\Mapper\Tracking();
			$mTD 			= new \MVC\Mapper\TrackingDaily();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName	= $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			
			$CollectGeneralAll = $mCollectGeneral->findByTracking( array($TD->getDate(), $TD->getDate()));			
			$GeneralValue = 0;
			while ($CollectGeneralAll->valid()){
				$Collect 		= $CollectGeneralAll->current();
				$GeneralValue 	+= $Collect->getValue();
				$CollectGeneralAll->next();
			}			
			$NGeneralValue = new \MVC\Library\Number($GeneralValue);
			
			$CollectCustomerAll = $mCollectCustomer->findByTracking1( array($TD->getDate(), $TD->getDate()));
			$CustomerValue = 0;
			while ($CollectCustomerAll->valid()){
				$Collect 		= $CollectCustomerAll->current();
				$CustomerValue 	+= $Collect->getValue();
				$CollectCustomerAll->next();
			}			
			$NCustomerValue = new \MVC\Library\Number($CustomerValue);
			
			//Cập nhật kết quả vào DB
			$TD->setCollect($GeneralValue + $CustomerValue);
			$mTD->update($TD);
			
			$Title 		= "THU ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('TD'			, $TD);
			
			$request->setObject('NGeneralValue'	, $NGeneralValue);
			$request->setObject('CollectGeneralAll'	, $CollectGeneralAll);
			
			$request->setObject('NCustomerValue'	, $NCustomerValue);
			$request->setObject('CollectCustomerAll', $CollectCustomerAll);
		}
	}
?>