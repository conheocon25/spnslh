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
			$mCollect 	= new \MVC\Mapper\CollectGeneral();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName	= $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			
			$CollectAll = $mCollect->findByTracking( array(
				$TD->getDate(), 
				$TD->getDate()
			));
			
			$Value 		= 0;
			while ($CollectAll->valid()){
				$Collect 	= $CollectAll->current();
				$Value 	+= $Collect->getValue();
				$CollectAll->next();
			}			
			$NTotal = new \MVC\Library\Number($Value);
			
			//Cập nhật kết quả vào DB
			$TD->setCollect($Value);
			$mTD->update($TD);
			
			$Title 		= "TIỀN THU".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('NTotal'		, $NTotal);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('CollectAll'	, $CollectAll);
		}
	}
?>