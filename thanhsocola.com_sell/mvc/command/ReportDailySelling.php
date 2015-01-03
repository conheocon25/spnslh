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
			$mSession 	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
			
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mPG 		= new \MVC\Mapper\PaidGeneral();
			$mPE 		= new \MVC\Mapper\PaidEmployee();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																	
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
						
			//TỔNG KẾT CA1 00:00 ĐẾN TRƯỚC 23:59
			$SessionAll = $mSession->findByTracking( array(
				$TD->getDate()." 0:0:0",
				$TD->getDate()." 23:59:59"
			));			
			
			$Value = 0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();				
				$Value += $Session->getValue();
				$SessionAll->next();
			}			
			$TD->setSelling($Value);
			$mTD->update($TD);			
			$NTotal 	= new \MVC\Library\Number($Value);

			//2.1 CHI CHO KHÁC
			$PGAll 	= $mPG->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PGValue = 0;
			while ($PGAll->valid()){
				$PG = $PGAll->current();				
				$PGValue += $PG->getValue();
				$PGAll->next();
			}			
			$NPGValue 	= new \MVC\Library\Number($PGValue);
			
			//2.2 CHI CHO NHÂN VIÊN
			$PEAll 	= $mPE->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PEValue = 0;
			while ($PEAll->valid()){
				$PE = $PEAll->current();				
				$PEValue += $PE->getValue();
				$PEAll->next();
			}			
			$NPEValue 	= new \MVC\Library\Number($PEValue);
			
			//2.3 CHI CHO NHÀ CUNG CẤP
			$PSAll 	= $mPS->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PSValue = 0;
			while ($PSAll->valid()){
				$PS = $PSAll->current();				
				$PSValue += $PS->getValue();
				$PSAll->next();
			}			
			$NPSValue 	= new \MVC\Library\Number($PSValue);
			
			$Title 		= $TD->getDatePrint()." - SỐ DƯ";
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TD'			, $TD);						
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('SessionAll'	, $SessionAll);
			$request->setObject('NTotal'		, $NTotal);
			
			$request->setObject('PSAll'			, $PSAll);
			$request->setObject('NPSValue'		, $NPSValue);
			
			$request->setObject('PEAll'			, $PEAll);
			$request->setObject('NPEValue'		, $NPEValue);
			
			$request->setObject('PGAll'			, $PGAll);
			$request->setObject('NPGValue'		, $NPGValue);
						
		}
	}	
?>