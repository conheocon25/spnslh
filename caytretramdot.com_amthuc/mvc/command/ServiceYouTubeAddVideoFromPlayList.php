<?php
	namespace MVC\Command;	
	class ServiceYouTubeAddVideoFromPlayList extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory	= $request->getProperty("IdCategory");
			$DTitle 	= $request->getProperty("DTitle");
			$DURL 		= $request->getProperty("DURL");
			$DViewed 	= $request->getProperty("DViewed");
			$DLiked 	= $request->getProperty("DLiked");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 	= new \MVC\Mapper\Config();
			$mVideo 	= new \MVC\Mapper\Video();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			\ini_set('max_execution_time', 300); //300 seconds = 5 minutes
			
			for ($i = 0; $i< count($DURL); $i++)
			{															
				$Video = new \MVC\Domain\Video(
					null,
					$IdCategory,
					$DTitle[$i],
					"",
					date('Y-m-d H:i:s'),
					$DURL[$i],
					$DViewed[$i],
					$DLiked[$i],
					""
				);
						
				$Video->reKey();
				$mVideo->insert($Video);
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>