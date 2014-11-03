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
			$KTag 	= $request->getProperty('KTag');
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
			$Post 					= $mPost->findByKey($KPost);
			$Tag 					= $mTag->findByKey($KTag);
			$TagAll 				= $mTag->findByPosition(array(1));
			
			$URLShare = "http://caytretramdot.com/bai-viet/".$KTag."/".$KPost;
			$Post->setViewed($Post->getViewed()+1);
			$mPost->update($Post);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("URLShare", 			$URLShare);
			
			$request->setObject("Post", 				$Post);			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$Tag);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>