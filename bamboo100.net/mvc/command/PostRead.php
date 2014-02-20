<?php
	namespace MVC\Command;	
	class PostRead extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KIdPost = $request->getProperty('KIdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mPost = new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Post 		= $mPost->findByKey($KIdPost);
			$Post->setCount($Post->getCount()+1);
			$mPost->update($Post);
			
			$Navigation = array();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 	'Trang chủ');
			$request->setObject('Post', 	$Post);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>