<?php		
	namespace MVC\Command;	
	class ReportDailySupplierDetail extends Command{
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
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTS 		= new \MVC\Mapper\TrackingSupplier();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mOrder 	= new \MVC\Mapper\OrderImport();
			$mPS 		= new \MVC\Mapper\PaidSupplier();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 	= $mTracking->find($IdTrack);
			$TD 		= $mTD->find($IdTD);
			$Supplier 	= $mSupplier->find($IdSupplier);
			$ConfigName	= $mConfig->findByName("NAME");
			
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView()),
				array($TD->getDatePrint()	, $TD->getURLReportSupplier())
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
					0
				);
			}else{
				$TS = $TSAll->current();
			}
						
			//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
			$OrderAll = $mOrder->findByTracking1(array($IdSupplier, $Tracking->getDateStart(), $TD->getDate()));
			$VImport = 0;
			while ($OrderAll->valid()){
				$Order 	= $OrderAll->current();
				$VImport += $Order->getValue();
				$OrderAll->next();
			}
			$NVImport = new \MVC\Library\Number($VImport);
			
			//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
			$PaidAll = $mPS->findByTracking1(array($IdSupplier, $Tracking->getDateStart(), $TD->getDate()));
			$VPaid= 0;
			while ($PaidAll->valid()){
				$Paid 	= $PaidAll->current();
				$VPaid 	+= $Paid->getValue();
				$PaidAll->next();
			}
			$NVPaid = new \MVC\Library\Number($VPaid);
			
			//TÍNH NỢ MỚI			
			$VOld	= $TS->getValue();
			$NVOld 	= new \MVC\Library\Number($VOld);
			
			$VNew	= $VOld + $VImport - $VPaid;
			$NVNew 	= new \MVC\Library\Number($VNew);
			
			//NẾU LÀ NGÀY CUỐI THÁNG THÌ TỔNG KẾT SỔ THÁNG
			if ($TD->getDate() == $Tracking->getDateEnd()){
				$TSAll = $mTS->findBy1(array($IdTrack, $IdSupplier));
				if ($TSAll->count()==0){
					$TS = new \MVC\Domain\TrackingSupplier(
						null,
						$IdTrack,
						$IdSupplier,
						$VImport,						
						$VPaid
					);
					$mTS->insert($TS);
				}else{
					$TS = $TSAll->current();
					$TS->setValueImport($VImport);
					$TS->setValuePaid($VPaid);
					$mTS->update($TS);
				}
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'	, $Title);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('Tracking'	, $Tracking);
			$request->setObject('TD'		, $TD);
			$request->setObject('Supplier'	, $Supplier);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setObject('PaidAll'	, $PaidAll);
			$request->setObject('OrderAll'	, $OrderAll);
			$request->setObject('NVPaid'	, $NVPaid);
			$request->setObject('NVImport'	, $NVImport);
			$request->setObject('NVOld'		, $NVOld);
			$request->setObject('NVNew'		, $NVNew);
		}
	}
?>