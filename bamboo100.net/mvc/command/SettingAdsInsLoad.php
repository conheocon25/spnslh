<?php
	namespace MVC\Command;	
	class SettingAdsInsLoad extends Command{
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
				array("RAO VẶT", 	"/quan-ly/rao-vat")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject( 'Navigation', 		$Navigation );
			$request->setProperty('ActiveLeftMenu', 'SettingPost');
			$request->setProperty("Title", 			"THÊM MỚI");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>