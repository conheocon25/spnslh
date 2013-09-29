<?php		
	namespace MVC\Command;	
	class ReportGeneral extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking = new \MVC\Mapper\Tracking();			
			$mSupplier = new \MVC\Mapper\Supplier();
			$mTerm = new \MVC\Mapper\TermPaid();
			$mTermCollect = new \MVC\Mapper\TermCollect();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Tracking = $mTracking->find($IdTrack);			
			$SupplierAll = $mSupplier->findAll();
			$TermAll = $mTerm->findAll();
			$TermCollectAll = $mTermCollect->findAll();
						
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			$Title = "BÁO CÁO TỔNG HỢP THÁNG ".\date("m/Y", strtotime( $Tracking->getDateStart() ));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			$request->setObject('Tracking', $Tracking);
			$request->setObject('SupplierAll', $SupplierAll);
			$request->setObject('TermAll', $TermAll);
			$request->setObject('TermCollectAll', $TermCollectAll);
		}
	}
?>