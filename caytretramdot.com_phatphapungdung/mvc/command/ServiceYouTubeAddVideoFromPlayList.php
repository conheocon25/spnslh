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
				    $Id = preg_replace('~
					# Match non-linked youtube URL in the wild. (Rev:20130823)
					https?://         # Required scheme. Either http or https.
					(?:[0-9A-Z-]+\.)? # Optional subdomain.
					(?:               # Group host alternatives.
					  youtu\.be/      # Either youtu.be,
					| youtube         # or youtube.com or
					  (?:-nocookie)?  # youtube-nocookie.com
					  \.com           # followed by
					  \S*             # Allow anything up to VIDEO_ID,
					  [^\w\s-]       # but char before ID is non-ID char.
					)                 # End host alternatives.
					([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
					(?=[^\w-]|$)     # Assert next char is non-ID or EOS.
					(?!               # Assert URL is not pre-linked.
					  [?=&+%\w.-]*    # Allow URL (query) remainder.
					  (?:             # Group pre-linked alternatives.
						[\'"][^<>]*>  # Either inside a start tag,
					  | </a>          # or inside <a> element text contents.
					  )               # End recognized pre-linked alts.
					)                 # End negative lookahead assertion.
					[?=&+%\w.-]*        # Consume any URL (query) remainder.
					~ix', 
					'$1',
					$DURL[$i]);
								
				$Video = new \MVC\Domain\Video(
					null,
					$IdCategory,
					$DTitle[$i],
					"",
					date('Y-m-d H:i:s'),
					$Id,
					$DViewed[$i],
					1,
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