<?php
	namespace MVC\Command;	
	class SettingCategoryKnowledgeDelLoad extends Command{
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
			$Category = $mCategoryKnowledge->find($IdCategory);
			
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Agencies = $mAgency->findAll();
			$Contacts = $mContact->findAll();
			
			$Title = mb_strtoupper("THIẾT LẬP / KIẾN THỨC / ".$Category->getName()." / XÓA", 'UTF8');
			$URLBack = "/setting/category/knowledge";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Agencies", $Agencies);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Category", $Category);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);						
			$request->setProperty("ActiveSetting", 'CategoryGeneral');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>