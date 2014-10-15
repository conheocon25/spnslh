<?php		
	namespace MVC\Command;	
	class ReportDailySellingDebt extends Command {
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
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
						
			//TỔNG KẾT CA1 00:00 ĐẾN TRƯỚC 23:59
			$SessionAll = $mSession->findByTrackingDebt( array(
				$TD->getDate()." 0:0:0",
				$TD->getDate()." 23:59:59"
			));			
			
			$Value = 0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();				
				$Value += $Session->getValue(); 
				$SessionAll->next();
			}			
			//TỔNG CỘNG
			$NTotal 	= new \MVC\Library\Number($Value);
			
			$TD->setSellingDebt($Value);
			$mTD->update($TD);
			
			$Title 		= "BÁN CÔNG NỢ - ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
									
			$request->setObject('SessionAll'	, $SessionAll);
			$request->setObject('NTotal'		, $NTotal);
			$request->setObject('TD'			, $TD);
						
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>