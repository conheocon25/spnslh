<?php
	namespace MVC\Command;	
	class SettingWarehouseGroup extends Command {
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
			$mWarehouseGroup 	= new \MVC\Mapper\WarehouseGroup();
			$mConfig 			= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$WarehouseGroupAll = $mWarehouseGroup->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$WarehouseGroupAll1 	= $mWarehouseGroup->findByPage(array($Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($WarehouseGroupAll->count(), $Config->getValue(), "/ql-thiet-lap/kho-hang");
			
			$Title = "NHÓM KHO HÀNG";
			$Navigation = array(array("THIẾT LẬP", "/ql-thiet-lap"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'				, $Page);
			$request->setObject('PN'					, $PN);
			$request->setObject('WarehouseGroupAll1'	, $WarehouseGroupAll1);
			
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>