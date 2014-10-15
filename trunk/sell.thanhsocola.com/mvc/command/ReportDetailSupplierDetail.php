<?php		
	namespace MVC\Command;	
	class ReportDetailSupplierDetail extends Command{
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
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSupplier 	= new \MVC\Mapper\Supplier();			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTS 		= new \MVC\Mapper\TrackingSupplier();
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mOI 		= new \MVC\Mapper\OrderImport();
			$mOE 		= new \MVC\Mapper\OrderExport();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 	= $mTracking->find($IdTrack);			
			$Supplier 	= $mSupplier->find($IdSupplier);
			$ConfigName	= $mConfig->findByName("NAME");
			
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())			
			);
			$Title 	= mb_strtoupper($Supplier->getName(), 'UTF8');
						
			//TÍNH NỢ CŨ CỦA KHÁCH HÀNG
			$TSAll = $mTS->findByPre(array($IdTrack, $IdSupplier));
			if ($TSAll->count()==0){
				$TS = new \MVC\Domain\TrackingSupplier(
					null,
					$IdTrack,
					$IdSupplier,
					0,
					0,
					0
				);				
			}else{				
				$TS = $TSAll->current();
			}
						
			//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
			$D1 		= $Tracking->getDateStart()." 1:0:0";
			$D2 		= $Tracking->getDateEnd()." 23:59:59";
			$OrderAll 	= $mOI->findByTracking1(array($IdSupplier, $D1, $D2));
			
			//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
			$D1 		= $Tracking->getDateStart()." 1:0:0";
			$D2 		= $Tracking->getDateEnd()." 23:59:59";
			$OrderAll 	= $mOI->findByTracking1(array($Supplier->getId(), $D1, $D2));
				
			$SValueOrder = 0;
			while ($OrderAll->valid()){
				$Order = $OrderAll->current();					
				$SValueOrder += $Order->getValue();
				$OrderAll->next();
			}
			$NSValueOrder	= new \MVC\Library\Number($SValueOrder);
			
			//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
			$PaidAll = $mPS->findByTracking1(array($Supplier->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
			$SValuePaid = 0;
			while ($PaidAll->valid()){
				$Paid = $PaidAll->current();
				$SValuePaid += $Paid->getValue();
				$PaidAll->next();
			}
			$NSValuePaid	= new \MVC\Library\Number($SValuePaid);
			
			$TS1 = new \MVC\Domain\TrackingSupplier(
				null,
				$IdTrack,
				$Supplier->getId(),
				$SValueOrder,
				$SValuePaid,
				$TS->getValue()
			);
				
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'	, $Title);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('Tracking'	, $Tracking);			
			$request->setObject('Supplier'	, $Supplier);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setObject('OrderAll', $OrderAll);			
			$request->setObject('PaidAll', 	$PaidAll);
			
			$request->setObject('TS', 	$TS);
			$request->setObject('TS1', 	$TS1);
			$request->setProperty('SValuePaid', 	$NSValuePaid);
			$request->setProperty('SValueOrder'	, 	$NSValueOrder);
		}
	}
?>