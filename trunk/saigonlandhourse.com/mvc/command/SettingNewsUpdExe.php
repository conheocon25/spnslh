<?php
	namespace MVC\Command;	
	class SettingNewsUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdNews = $request->getProperty('Id');						
			$Author = $request->getProperty('Author');
			$Date = $request->getProperty('Date');
			$Content = \stripslashes($request->getProperty('Content'));
			$Title = $request->getProperty('Title');
			$Type = $request->getProperty('Type');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mNews = new \MVC\Mapper\News();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($IdNews))
				return self::statuses('CMD_OK');	
			if ($Type=="on")
				$Type=1;
			else
				$Type=0;
				
			$Str = new \MVC\Library\String($Title." ".$IdNews);
			$News = $mNews->find($IdNews);			
			$News->setAuthor($Author);
			$News->setContent($Content);
			$News->setDate($Date);
			$News->setTitle($Title);
			$News->setType($Type);
			$News->reKey();
			$mNews->update($News);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
