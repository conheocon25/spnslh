<?php
	namespace MVC\Command;	
	class ASettingWarehouse extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$WarehouseAll = $mWarehouse->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$WarehouseAll1 		= $mWarehouse->findByPage(array($Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($WarehouseAll->count(), $Config->getValue(), "/admin/setting/warehouse");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);									
			$request->setObject('WarehouseAll1'	, $WarehouseAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>