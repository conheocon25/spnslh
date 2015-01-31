<?php
	namespace MVC\Command;	
	class AVideoUpdExe extends Command{
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
			$IdVideo 	= $request->getProperty('IdVideo');
			$Title 		= $request->getProperty('Title');			
			$Time 		= date('Y-m-d H:i:s');
			$Info 		= \stripslashes($request->getProperty('Info'));
			$IdYouTube 	= $request->getProperty('IdYouTube');
			$Viewed 	= $request->getProperty('Viewed');
			$Liked 		= $request->getProperty('Liked');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mVideo = new \MVC\Mapper\Video();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Str = new \MVC\Library\String($Title." ".$IdVideo);
			$Video = $mVideo->find($IdVideo);
			
			$Video->setInfo($Info);			
			$Video->setTitle($Title);
			$Video->setTime($Time);
			$Video->setIdYouTube($IdYouTube);
			$Video->setViewed($Viewed);
			$Video->setLiked($Liked);			
			$Video->reKey();
			$mVideo->update($Video);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>