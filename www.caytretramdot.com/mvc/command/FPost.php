<?php
	namespace MVC\Command;	
	class FPost extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$KPost 	= $request->getProperty('KPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();			
			$mPost 		= new \MVC\Mapper\Post();
			$mPostTag 	= new \MVC\Mapper\PostTag();
			$mTag 		= new \MVC\Mapper\Tag();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Post 		= $mPost->findByKey($KPost);
			$TagAll 	= $mTag->findAll();			
						
			$URLShare = "http://caytretramdot.com/bai-viet/".$KPost;
			$Post->setViewed($Post->getViewed()+1);
			$mPost->update($Post);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("URLShare", 			$URLShare);
			
			$request->setObject("Post", 				$Post);
			$request->setObject("TagAll", 				$TagAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>