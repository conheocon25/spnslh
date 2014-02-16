<?php
	namespace MVC\Command;	
	class SettingNewsInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdCategory = $request->getProperty('IdCategory');						
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
			if (!isset($Title))
				return self::statuses('CMD_OK');
			if ($Type=="on")
				$Type=1;
			else
				$Type=0;
				
			$News = new \MVC\Domain\News(
				null,
				$IdCategory,
				$Author,
				null,
				$Content,
				$Title,
				$Type,
				""
			);
			$News->reKey();
			$mNews->insert($News);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>
