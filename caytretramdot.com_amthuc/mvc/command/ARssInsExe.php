<?php
	namespace MVC\Command;	
	class ARssInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$Name 		= $request->getProperty('Name');
			$Weburl 	= $request->getProperty('Weburl');
			$Rssurl 	= $request->getProperty('Rssurl');
			$Type 		= $request->getProperty('Type');
			$Enable 	= $request->getProperty('Enable');
			$IdCategory = $request->getProperty('IdCategory');
			
			$ClassContentName = $request->getProperty('ClassContentName');
			$ClassAuthor = $request->getProperty('ClassAuthor');
			$ImgPath = $request->getProperty('ImgPath');
			
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mRssLink = new \MVC\Mapper\RssLink();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$dRssLink = new \MVC\Domain\RssLink(								
				null,
				$IdCategory,
				$Name,
				$Weburl,
				$Rssurl,
				$Type,
				$Enable,
				$ClassContentName,
				$ClassAuthor,
				$ImgPath
			);
			//$dRssLink->reKey();
			$mRssLink->insert($dRssLink);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
