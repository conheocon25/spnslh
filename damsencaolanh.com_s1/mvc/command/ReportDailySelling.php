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
			$mPC 		= new \MVC\Mapper\PaidCustomer();
			$mPG 		= new \MVC\Mapper\PaidGeneral();
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mCC 		= new \MVC\Mapper\CollectCustomer();
			$mCG 		= new \MVC\Mapper\CollectGeneral();
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
			
			//2.1. CHI CHUNG
			$PGAll = $mPG->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PGValue = 0;
			while($PGAll->valid()){
				$PG = $PGAll->current();
				$PGValue+= $PG->getValue();
				$PGAll->next();
			}
			$NPGValue = new \MVC\Library\Number($PGValue);
			
			//2.2. CHI KHÁCH NỢ PHIẾU
			$PCAll = $mPC->findByTracking1(array($TD->getDate(), $TD->getDate()));
			$PCValue = 0;
			while($PCAll->valid()){
				$PC = $PCAll->current();
				$PCValue += $PC->getValue();
				$PCAll->next();
			}
			$NPCValue = new \MVC\Library\Number($PCValue);
			
			//2.3. CHI NHÀ CUNG CẤP
			$PSAll = $mPS->findByTracking(array($TD->getDate(), $TD->getDate()));
			$PSValue = 0;
			while($PSAll->valid()){
				$PS = $PSAll->current();
				$PSValue+= $PS->getValue();
				$PSAll->next();
			}
			$NPSValue = new \MVC\Library\Number($PSValue);
															
									
						
			//1.1 THU BÁN HÀNG
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
			$NTotal 	= new \MVC\Library\Number($Value1);
			$NTotal1 	= new \MVC\Library\Number($Value1); 
			$NTotal2 	= new \MVC\Library\Number($Value2);
			
			//1.2. THU TỪ KHÁCH HÀNG TRẢ
			$CCAll = $mCC->findByTracking1(array($TD->getDate(), $TD->getDate()));
			$CCValue = 0;
			while($CCAll->valid()){
				$CC = $CCAll->current();
				$CCValue += $CC->getValue();
				$CCAll->next();
			}
			$NCCValue = new \MVC\Library\Number($CCValue);
			
			//1.3. THU KHÁC
			$CGAll = $mCG->findByTracking(array($TD->getDate(), $TD->getDate()));
			$CGValue = 0;
			while($CGAll->valid()){
				$CG = $CGAll->current();
				$CGValue+= $CG->getValue();
				$CGAll->next();
			}
			$NCGValue = new \MVC\Library\Number($CGValue);
												
			$Summary 	= ($Value1 + $CCValue + $CGValue) - ($PGValue + $PCValue + $PSValue);
			$NSummary 	= new \MVC\Library\Number($Summary);
			
			//Update vào Daily
			$TD->setSelling($Summary);
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
			
			$request->setObject('PGAll'			, $PGAll);
			$request->setObject('NPGValue'		, $NPGValue);
			
			$request->setObject('PCAll'			, $PCAll);
			$request->setObject('NPCValue'		, $NPCValue);
			
			$request->setObject('PSAll'			, $PSAll);
			$request->setObject('NPSValue'		, $NPSValue);
			
			$request->setObject('CCAll'			, $CCAll);
			$request->setObject('NCCValue'		, $NCCValue);
			
			$request->setObject('CGAll'			, $CGAll);
			$request->setObject('NCGValue'		, $NCGValue);
			
			$request->setObject('NSummary'		, $NSummary);
			
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