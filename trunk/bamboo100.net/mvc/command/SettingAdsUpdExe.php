<?php
	namespace MVC\Command;	
	class SettingAdsUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdPost 	= $request->getProperty('IdPost');
			$DateTime 	= $request->getProperty('DateTime');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Title 		= $request->getProperty('Title');
			$Count 		= $request->getProperty('Count');
						
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
			$Post->setDateTime($DateTime);
			$Post->setTitle($Title);
			$Post->setCount($Count);
			$Post->reKey();
			$mPost->update($Post);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
