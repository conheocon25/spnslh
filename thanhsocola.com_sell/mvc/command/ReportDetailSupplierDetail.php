<?php		
	namespace MVC\Command;	
	class ReportDetailSupplierDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack 	= $request->getProperty("IdTrack");
			$IdTS 		= $request->getProperty("IdTS");
			$Action 	= $request->getProperty("action");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking	= new \MVC\Mapper\Tracking();
			$mTS 		= new \MVC\Mapper\TrackingSupplier();
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mOrder 	= new \MVC\Mapper\OrderImport();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Tracking			= $mTracking->find($IdTrack);						
			$TS 				= $mTS->find($IdTS);
			$TSPre				= $mTS->findByPre(array($IdTrack, $TS->getIdSupplier()));
						
			if ($TSPre->count()>0){
				$ValueOld 		= $TSPre->current()->getValue();
				$ValueOldGlobal = $TSPre->current()->getValueGlobal();
				$CountOldGlobal = $TSPre->current()->getCountGlobal();
			}else{
				$ValueOld 		= $TS->getSupplier()->getDebt();
				$ValueOldGlobal = 0;
				$CountOldGlobal = 0;
			}
			//$TS->setValueOld($ValueOld);
						
			$OrderAll 		= $mOrder->findByTracking1(array($TS->getIdSupplier(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
			$PaidAll 		= $mPS->findByTracking1(array($TS->getIdSupplier(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
			
			$PaidValue 	= 0;
			while ($PaidAll->valid()){
				$Paid = $PaidAll->current();
				$PaidValue += $Paid->getValue();
				$PaidAll->next();
			}
			$TS->setValuePaid($PaidValue);
						
			$Import = 0;
			$Count 	= 0;
			while ($OrderAll->valid()){
				$Order = $OrderAll->current();
				$Import 	+= $Order->getValue();
				$Count		+= $Order->getCount();
				$OrderAll->next();
			}
			$TS->setValueImport($Import);
			$TS->setCount($Count);
			
			$Value = $ValueOld + $Import - $PaidValue;
			$TS->setValue($Value);
			
			$ValueGlobal = $ValueOldGlobal + $Import;
			$TS->setValueGlobal($ValueGlobal);
			
			$CountGlobal = $CountOldGlobal + $Count;
			$TS->setCountGlobal($CountGlobal);
			
			$mTS->update($TS);
			
			$NValueOld 			= number_format($ValueOld, 0, ',', '.');
			$NValueOldGlobal 	= number_format($ValueOldGlobal, 0, ',', '.');
			$NCountOldGlobal 	= number_format($CountOldGlobal, 1, ',', '.');
			
			$ConfigName 		= $mConfig->findByName("NAME");					
			$Title 				= mb_strtoupper($TS->getSupplier()->getName(), 'UTF8');
			$Navigation = array(
				array("BÁO CÁO", "/report"),
				array($Tracking->getName(). "/ NHÀ CUNG CẤP", $Tracking->getURLSupplier())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'			, $Title);			
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setProperty('ValueOld'		, $NValueOld);
			$request->setProperty('ValueOldGlobal'	, $NValueOldGlobal);
			$request->setProperty('CountOldGlobal'	, $NCountOldGlobal);
												
			$request->setObject('Tracking'			, $Tracking);
			$request->setObject('TS'				, $TS);
			
			$request->setObject('OrderAll'			, $OrderAll);							
			$request->setObject('PaidAll'			, $PaidAll);			
			
			$request->setObject('ConfigName'		, $ConfigName);
		}
	}
?>