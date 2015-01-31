<?php
	namespace MVC\Command;	
	class AVideoInsExe extends Command {
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
			$Title 		= $request->getProperty('Title');
			$Time 		= date('Y-m-d H:i:s');
			$Info 		= \stripslashes($request->getProperty('Info'));			
			$IdYouTube 	= $request->getProperty('IdYouTube');			
			$Time	 	= $request->getProperty('Time');
			$Viewed	 	= $request->getProperty('Viewed');
			$Liked	 	= $request->getProperty('Liked');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mVideo 	= new \MVC\Mapper\Video();			
								
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Video = new \MVC\Domain\Video(
				null,
				$IdCategory,
				$Title,
				$Info,				
				$Time,				
				$IdYouTube,
				$Viewed,
				$Liked,
				""
			);
					
			$Video->reKey();
			$mVideo->insert($Video);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
