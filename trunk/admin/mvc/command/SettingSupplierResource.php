<?php
	namespace MVC\Command;	
	class SettingSupplierResource extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty("Page");
			$IdSupplier = $request->getProperty("IdSupplier");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSupplier = new \MVC\Mapper\Supplier();
			$mResource = new \MVC\Mapper\Resource();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$SupplierAll = $mSupplier->findAll();
			$Supplier = $mSupplier->find($IdSupplier);
			
			$Title = mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting"),
				array("NHÀ CUNG CẤP", "/setting/supplier")
			);
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$ResourceAll = $mResource->findByPage(array($IdSupplier, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Supplier->getResourceAll()->count(), $Config->getValue(), $Supplier->getURLResource());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Supplier", $Supplier);
			$request->setObject("SupplierAll", $SupplierAll);
			$request->setObject("ResourceAll", $ResourceAll);
						
			$request->setProperty("Title", $Title);
			$request->setProperty("Page", $Page);
			$request->setObject("Navigation", $Navigation);
			$request->setObject("PN", $PN);
		}
	}
?>