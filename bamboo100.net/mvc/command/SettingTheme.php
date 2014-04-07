<?php
	namespace MVC\Command;	
	class SettingTheme extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTCategory = new \MVC\Mapper\TCategory();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "QUẢN LÝ MẪU WEB";
			$Navigation = array(array("QUẢN LÝ", "/quan-ly"));
			
			$TCategoryAll = $mTCategory->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingTheme');
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('TCategoryAll', 	$TCategoryAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>