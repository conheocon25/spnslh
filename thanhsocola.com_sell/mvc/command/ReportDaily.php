<?php		
	namespace MVC\Command;	
	class ReportDaily extends Command {
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
			
			$mCC 		= new \MVC\Mapper\CollectCustomer();
			$mCG 		= new \MVC\Mapper\CollectGeneral();
			
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mPG 		= new \MVC\Mapper\PaidGeneral();
			$mPE 		= new \MVC\Mapper\PaidEmployee();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																	
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
									
			$SessionAll = $mSession->findByTracking( array(
				$TD->getDate()." 0:0:0",
				$TD->getDate()." 23:59:59"
			));			
			
			//1.1 THU BÁN HÀNG
			$Value = 0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();				
				$Value += $Session->getValue();
				$SessionAll->next();
			}			
			$TD->setCollect1($Value);			
			$NTotal 	= new \MVC\Library\Number($Value);
			
			//1.2 THU KHÁC						
			$CGValue = 0;
			$CGAll 	= $mCG->findByTracking(array($TD->getDate(), $TD->getDate()));
			while ($CGAll->valid()){
				$CG = $CGAll->current();				
				$CGValue += $CG->getValue();
				$CGAll->next();
			}
			$TD->setCollect2($CGValue);
			$NCGValue 	= new \MVC\Library\Number($CGValue);
			
			//1.3 THU KHÁCH HÀNG
			$CCValue = 0;
			$CCAll 	= $mCC->findByTracking(array($TD->getDate(), $TD->getDate()));
			while ($CCAll->valid()){
				$CC = $CCAll->current();				
				$CCValue += $CC->getValue();
				$CCAll->next();
			}
			$TD->setCollect3($CCValue);
			$NCCValue 	= new \MVC\Library\Number($CCValue);
			

			//2.1 CHI CHO KHÁC
			$PGAll 	= $mPG->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PGValue = 0;
			while ($PGAll->valid()){
				$PG = $PGAll->current();				
				$PGValue += $PG->getValue();
				$PGAll->next();
			}
			$TD->setPaid1($PGValue);
			$NPGValue 	= new \MVC\Library\Number($PGValue);
			
			//2.2 CHI CHO NHÂN VIÊN
			$PEAll 	= $mPE->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PEValue = 0;
			while ($PEAll->valid()){
				$PE = $PEAll->current();				
				$PEValue += $PE->getValue();
				$PEAll->next();
			}
			$TD->setPaid2($PEValue);
			$NPEValue 	= new \MVC\Library\Number($PEValue);
			
			//2.3 CHI CHO NHÀ CUNG CẤP
			$PSAll 	= $mPS->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PSValue = 0;
			while ($PSAll->valid()){
				$PS = $PSAll->current();				
				$PSValue += $PS->getValue();
				$PSAll->next();
			}
			$TD->setPaid3($PSValue);
			$NPSValue 	= new \MVC\Library\Number($PSValue);
			
			$TD->reValue();
			$mTD->update($TD);
			
			$Tracking->reValue();
			$mTracking->update($Tracking);
			
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
			
			$request->setObject('CGAll'			, $CGAll);
			$request->setObject('NCGValue'		, $NCGValue);
			
			$request->setObject('CCAll'			, $CCAll);
			$request->setObject('NCCValue'		, $NCCValue);
			
			$request->setObject('PSAll'			, $PSAll);
			$request->setObject('NPSValue'		, $NPSValue);
			
			$request->setObject('PEAll'			, $PEAll);
			$request->setObject('NPEValue'		, $NPEValue);
			
			$request->setObject('PGAll'			, $PGAll);
			$request->setObject('NPGValue'		, $NPGValue);
		}
	}
?>