<?php		
	namespace MVC\Command;	
	class ExportSupplier extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier = $request->getProperty('IdSupplier');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$SupplierAll 	= $mSupplier->findAll();			
			$Supplier 		= $mSupplier->find($IdSupplier);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title = mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation = array(
				array("XUẤT HÀNG", "/export")
			);
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName 	= $mConfig->findByName("NAME");
			
			$OrderAll = $mOrderExport->findByPage(array($IdSupplier, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Supplier->getOrderExportAll()->count(), $Config->getValue(), $Supplier->getURLExport());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Title);
			$request->setProperty('Page', $Page);
			$request->setProperty('ActiveAdmin', 'Export');
			$request->setObject('Navigation', $Navigation);
			$request->setObject('PN', $PN);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setObject('SupplierAll', $SupplierAll);
			$request->setObject('OrderAll', $OrderAll);
			$request->setObject('Supplier', $Supplier);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>