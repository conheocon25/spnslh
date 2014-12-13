<?php		
	namespace MVC\Command;	
	class ReportDailySelling extends Command {
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
			$mDomain 	= new \MVC\Mapper\Domain();
			$mSession 	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$SessionAll  = null;
			$SessionAll1 = null;
			$SessionAll2 = null;
			
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			$DomainAll	= $mDomain->findAll();
												
			$SessionAll = $mSession->findByTracking( array(
				$TD->getDate()." 0:0:0",
				$TD->getDate()." 23:59:59"
			));			
			$Value1 		= 0;
			$Value2 		= 0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();
				if ($Session->checkDisable()==false)
					$Value1 += $Session->getValue();
				else	
					$Value2 += $Session->getValue();
					
				$SessionAll->next();
			}
			//TỔNG CỘNG
			$NTotal 	= new \MVC\Library\Number($Value1);
			$NTotal1 	= new \MVC\Library\Number($Value1); 
			$NTotal2 	= new \MVC\Library\Number($Value2);
						
			//Update vào Daily
			$TD->setSelling($Value1);
			$mTD->update($TD);
						
			$Title 	= "BÁN HÀNG ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('SessionAll1'	, $SessionAll1);
			$request->setObject('SessionAll2'	, $SessionAll2);
			
			$request->setObject('SessionAll'	, $SessionAll);
			
			$request->setObject('NTotal'		, $NTotal);
			$request->setObject('NTotal1'		, $NTotal1);
			$request->setObject('NTotal11'		, isset($NTotal11)==false?null:$NTotal11);
			$request->setObject('NTotal12'		, isset($NTotal12)==false?null:$NTotal12);
			$request->setObject('NTotal2'		, $NTotal2);
			$request->setObject('NTotal21'		, isset($NTotal21)==false?null:$NTotal21);
			$request->setObject('NTotal22'		, isset($NTotal22)==false?null:$NTotal22);
			
			$request->setObject('TD'			, $TD);
			$request->setObject('DomainAll'		, $DomainAll);
			
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>