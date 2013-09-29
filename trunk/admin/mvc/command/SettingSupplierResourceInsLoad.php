<?php	
	namespace MVC\Command;
	class SettingSupplierResourceInsLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();						
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier = $request->getProperty("IdSupplier");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mUnit = new \MVC\Mapper\Unit();
			$mSupplier = new \MVC\Mapper\Supplier();
			$mResource = new \MVC\Mapper\Resource();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------	
			$Units = $mUnit->findAll();
			$Supplier = $mSupplier->find($IdSupplier);			
			
			$Title = "THÊM MỚI";
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting"),
				array("NHÀ CUNG CẤP", "/setting/supplier"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Supplier->getURLResource())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Units", $Units);
			$request->setObject("Supplier", $Supplier);			
			$request->setProperty("Title", $Title);
			$request->setObject("Navigation", $Navigation);
		}
	}
?>