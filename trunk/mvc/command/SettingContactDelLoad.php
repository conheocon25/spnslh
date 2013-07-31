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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Agencies = $mAgency->findAll();
			$Contacts = $mContact->findAll();
						
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
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Agencies", $Agencies);
			$request->setObject("Contact", $Contact);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
			$request->setProperty("ActiveSetting", 'Contact');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>