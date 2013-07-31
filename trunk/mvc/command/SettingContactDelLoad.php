<?php
	namespace MVC\Command;	
	class SettingContactDelLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mContact = new \MVC\Mapper\Contact();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Contact = $mContact->find($IdContact);
			$Title = mb_strtoupper($Contact->getName(), 'UTF8');			
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting"),
				array("NHÀ MÔI GIỚI", "/setting/contact")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Contact", $Contact);
			
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
			$request->setProperty("ActiveSetting", 'Contact');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>