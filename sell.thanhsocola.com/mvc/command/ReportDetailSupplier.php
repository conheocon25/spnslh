<?php		
	namespace MVC\Command;	
	class ReportDetailSupplier extends Command{
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
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------									
			$mOI		= new \MVC\Mapper\OrderImport();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTS		= new \MVC\Mapper\TrackingSupplier();
			$mPS		= new \MVC\Mapper\PaidSupplier();
			$mSupplier	= new \MVC\Mapper\Supplier();
			$mConfig	= new \MVC\Mapper\Config();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Tracking		= $mTracking->find($IdTrack);			
			$ConfigName		= $mConfig->findByName("NAME");
			
			$SValue = 0;
			//XÓA PHÁT SINH TÍNH CÔNG NỢ			
			$mTS->deleteByTracking(array($IdTrack));
						
			//PHÁT SINH TÍNH CÔNG NỢ
			$SupplierAll 	= $mSupplier->findAll();
			while ($SupplierAll->valid()){
				$Supplier = $SupplierAll->current();
				
				//TÍNH NỢ CŨ CỦA NHÀ CUNG CẤP
				$TSAll = $mTS->findByPre( array($IdTrack, $Supplier->getId()) );
				if ($TSAll->count()==0){$ValueOld = 0;}
				else{$ValueOld = $TSAll->current()->getValue();}
						
				//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
				$D1 		= $Tracking->getDateStart()." 1:0:0";
				$D2 		= $Tracking->getDateEnd()." 23:59:59";
				$OrderAll = $mOI->findByTracking1(array($Supplier->getId(), $D1, $D2));
				
				$SValueImport = 0;
				while ($OrderAll->valid()){
					$Order = $OrderAll->current();					
					$SValueImport += $Order->getValue();
					$OrderAll->next();
				}
						
				//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
				$PaidAll = $mPS->findByTracking1(array($Supplier->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
				$SValuePaid = 0;
				while ($PaidAll->valid()){
					$Paid = $PaidAll->current();
					$SValuePaid += $Paid->getValue();
					$PaidAll->next();
				}
													
				$TS = new \MVC\Domain\TrackingSupplier(
					null,
					$IdTrack,
					$Supplier->getId(),
					$SValueImport,
					$SValuePaid,
					$ValueOld
				);
				$mTS->insert($TS);
				$SValue += $TS->getValue();
				$SupplierAll->next();
				
			}						
			$TSAll 		= $mTS->findByTracking(array($IdTrack));			
			$NSValue	= new \MVC\Library\Number($SValue);
			
			$Title 		= "CÔNG NỢ NHÀ CUNG CẤP";
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setProperty('SValue'		, $NSValue);
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('TSAll'			, $TSAll);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>