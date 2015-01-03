<?php
	namespace MVC\Command;	
	class APostPublished extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			
			$ListId = $request->getProperty('ListId');			
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost = new \MVC\Mapper\Post();
			$mPostRss = new \MVC\Mapper\PostRss();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (isset($ListId)){
			
				foreach ($ListId as $Id ) {
					
					$dPostRss = $mPostRss->find($Id);
						
					$Post = new \MVC\Domain\Post(
						null,
						$dPostRss->getIdCategory(),
						$dPostRss->getAuthor(),						
						$dPostRss->getDate(),
						$dPostRss->getContent(),
						$dPostRss->getTitle(),
						$dPostRss->getType(),
						""
					);
					$Post->reKey();
					$mPost->insert($Post);
					
					unset($Post);
					unset($dPostRss);
					
					$mPostRss->delete(array($Id));
				}
				
			//	return self::statuses('CMD_OK');
			}
			
			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
