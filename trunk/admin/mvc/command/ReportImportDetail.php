<?php		
	namespace MVC\Command;	
	class ReportImportDetail extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack = $request->getProperty('IdTrack');
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking = new \MVC\Mapper\Tracking();
			$mSupplier = new \MVC\Mapper\Supplier();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking = $mTracking->find($IdTrack);						
			$Supplier = $mSupplier->find($IdSupplier);			
			$Title = "NHẬP HÀNG ".mb_strtoupper($Supplier->getName(), 'UTF8')." THÁNG ".\date("m", strtotime($Tracking->getDateStart()))."/".\date("Y", strtotime($Tracking->getDateStart()));
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			$request->setObject('Tracking', $Tracking);
			$request->setObject('Supplier', $Supplier);
			$request->setProperty('URLHeader', $Tracking->getURLView() );
		}
	}
?>