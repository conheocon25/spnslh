<?php
	namespace MVC\Command;	
	class SettingKaraoke extends Command {
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
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "QUẢN LÝ KARAOKE";
			$Navigation = array(array("QUẢN LÝ", "/quan-ly"));
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingKaraoke');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>