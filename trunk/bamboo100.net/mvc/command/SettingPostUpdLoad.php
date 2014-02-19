<?php
	namespace MVC\Command;	
	class SettingPostUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdPost = $request->getProperty('IdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost = new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Post 	= $mPost->find($IdPost);
			
			$Navigation = array(				
				array("QUẢN LÝ", 	"/quan-ly"),				
				array("BÀI VIẾT", 	"/quan-ly/bai-viet")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'Post', 		$Post );			
			$request->setObject( 'Navigation', 	$Navigation );			
			$request->setProperty("Title", 		$Post->getTitle()." > CẬP NHẬT");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
