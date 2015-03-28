<?php
	namespace MVC\Command;	
	class SettingWarehouse extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdGroup 	= $request->getProperty('IdGroup');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mWarehouseGroup= new \MVC\Mapper\WarehouseGroup();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$GroupAll			= $mWarehouseGroup->findAll();
			$Group 				= $mWarehouseGroup->find($IdGroup);
			$WarehouseAll 		= $mWarehouse->findByGroup(array($IdGroup));
						
			if (!isset($Page)) $Page=1;
			$Config 			= $mConfig->findByName("ROW_PER_PAGE");
						
			$WarehouseAll1 		= $mWarehouse->findByGroupPage(array($IdGroup, $Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($WarehouseAll->count(), $Config->getValue(), $Group->getURLSetting());
			
			$Title 	= mb_strtoupper($Group->getName(), 'UTF8');
			$Navigation = array(
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("NHÓM KHO HÀNG", "/ql-thiet-lap/kho-hang")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Group'			, $Group);
			$request->setObject('GroupAll'		, $GroupAll);
			$request->setObject('WarehouseAll1'	, $WarehouseAll1);
			
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>