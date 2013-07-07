<?php
	namespace MVC\Command;	
	class SettingContactInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Name = $request->getProperty('Name');
			$PicURL = $request->getProperty('PicURL');
			$Website = $request->getProperty('Website');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mContact = new \MVC\Mapper\Contact();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Contact = new \MVC\Domain\Contact(
				null,
				$Name,
				$PicURL,				
				$Website
			);			
			$mContact->insert($Contact);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');
		}
	}
?>