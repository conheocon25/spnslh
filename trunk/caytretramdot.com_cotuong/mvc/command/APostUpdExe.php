<?php
	namespace MVC\Command;	
	class APostUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCategory = $request->getProperty('IdCategory');						
			$IdPost 	= $request->getProperty('IdPost');
			$Title 		= $request->getProperty('Title');			
			$Time 		= $request->getProperty('Time');			
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Viewed 	= $request->getProperty('Viewed');
			$Liked 		= $request->getProperty('Liked');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost = new \MVC\Mapper\Post();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Str = new \MVC\Library\String($Title." ".$IdPost);
			$Post = $mPost->find($IdPost);
			
			$Post->setContent($Content);			
			$Post->setTitle($Title);
			$Post->setTime($Time);			
			$Post->setViewed($Viewed);
			$Post->setLiked($Liked);			
			$Post->reKey();
			$mPost->update($Post);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>