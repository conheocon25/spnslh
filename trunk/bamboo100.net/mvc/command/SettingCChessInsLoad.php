<?php
	namespace MVC\Command;	
	class SettingCChessInsLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Navigation = array(				
				array("QUẢN LÝ", 	"/quan-ly"),
				array("CỜ TƯỚNG", 	"/quan-ly/hoc-co-tuong")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject( 'Navigation', 		$Navigation );
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setProperty("Title", 			"THÊM MỚI SÁCH");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
