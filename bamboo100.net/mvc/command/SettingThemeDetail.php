<?php
	namespace MVC\Command;	
	class SettingThemeDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTCategory = new \MVC\Mapper\TCategory();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TCategory 		= $mTCategory->find($IdCategory);
			$TCategoryAll 	= $mTCategory->findAll();
			
			$Title			= $TCategory->getName();
			$Navigation 	= array(array("QUẢN LÝ", "/quan-ly"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingTheme');
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('TCategoryAll', 	$TCategoryAll);
			$request->setObject('TCategory', 		$TCategory);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>