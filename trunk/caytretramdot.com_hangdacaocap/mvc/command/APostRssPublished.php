<?php
	namespace MVC\Command;	
	use MVC\Library\ReadRss;
	require_once('mvc/library/SimpleHtmlDom.php');	
	class APostRssPublished extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			
			$ListId = $request->getProperty('ListId');	
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			
			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------	
			
			\ini_set('max_execution_time', 50); //300 seconds = 5 minutes
			
					
			$mPostRss 		= new \MVC\Mapper\PostRss();
			$mPost 			= new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			
			if (isset($ListId)){
			
				foreach ($ListId as $Id ) {
					
					$dPostRss = $mPostRss->find($Id);
					
					$Post = new \MVC\Domain\Post(
						null,
						$dPostRss->getTitle(),
						$dPostRss->getContent(),
						$dPostRss->getAuthor(),						
						$dPostRss->getTime(),						
						$dPostRss->getCount(),
						$dPostRss->getKey(),
						$dPostRss->getViewed(),
						$dPostRss->getLiked()						
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