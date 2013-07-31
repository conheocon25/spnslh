<?php
	namespace MVC\Command;	
	class SettingContactUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdContact = $request->getProperty('IdContact');
			$Name = $request->getProperty('Name');
			$PicURL = $request->getProperty('PicURL');
			$Website = $request->getProperty('Website');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Contact = $mContact->find($IdContact);
			$Contact->setName($Name);
			$Contact->setPicURL($PicURL);
			$Contact->setWebsite($Website);
			$mContact->update($Contact);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');
		}
	}
?>