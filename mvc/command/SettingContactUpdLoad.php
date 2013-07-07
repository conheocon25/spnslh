<?php
	namespace MVC\Command;	
	class SettingContactUpdLoad extends Command{
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
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mAgency = new \MVC\Mapper\Agency();			
			$mContact = new \MVC\Mapper\Contact();
			
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
			$Title = mb_strtoupper("THIẾT LẬP / ĐỐI TÁC / ".$Contact->getName()." / CẬP NHẬT", 'UTF8');
			$URLBack = "/setting/contact";
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Agencies", $Agencies);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Contact", $Contact);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);			
			$request->setProperty("ActiveSetting", 'Contact');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>