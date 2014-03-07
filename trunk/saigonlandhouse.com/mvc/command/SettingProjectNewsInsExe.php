<?php
	namespace MVC\Command;	
	class SettingProjectNewsInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdProject		= $request->getProperty("IdProject");
			$Name			= $request->getProperty('Name');
			$Date			= $request->getProperty('Date');
			$Description	= \stripslashes($request->getProperty('Description'));
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPNews		= new \MVC\Mapper\PNews();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$PNews = new \MVC\Domain\PNews(			
				null,
				$IdProject,
				$Name,
				$Date,
				$Description,
				null
			);
			$PNews->reKey();
			$mPNews->insert($PNews);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>