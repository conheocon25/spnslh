<?php
	namespace MVC\Command;	
	class ARssUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdRss 	= $request->getProperty('IdRss');
			$Name 	= $request->getProperty('Name');
			$Weburl = $request->getProperty('Weburl');
			$Rssurl = $request->getProperty('Rssurl');
			$Type 	= $request->getProperty('Type');
			$Enable = $request->getProperty('Enable');
			$IdCategory = $request->getProperty('IdCategory');
			$ClassContentName = $request->getProperty('ClassContentName');
			$ClassAuthor = $request->getProperty('ClassAuthor');
			$ImgPath = $request->getProperty('ImgPath');
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mRss = new \MVC\Mapper\RssLink();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Rss = $mRss->find($IdRss);
			$Rss->setName($Name);
			$Rss->setIdTag($IdCategory);
			$Rss->setWeburl($Weburl);
			$Rss->setRssurl($Rssurl);
			$Rss->setType($Type);
			$Rss->setEnable($Enable);
			$Rss->setClassContentName($ClassContentName);
			$Rss->setClassAuthor($ClassAuthor);
			$Rss->setImgPath($ImgPath);
			$mRss->update($Rss);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
