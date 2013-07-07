<?php
	namespace MVC\Command;	
	class General extends Command{
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
			$Page = $request->getProperty('Page');
			if (!isset($Page)) $Page=1;
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mNewsGeneral = new \MVC\Mapper\NewsGeneral();
			$mProject = new \MVC\Mapper\Project();
			$mAgency = new \MVC\Mapper\Agency();
			$mContact = new \MVC\Mapper\Contact();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Category = $mCategoryGeneral->find($IdCategory);
			$Title = $Category->getName();
						
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Projects = $mProject->findAll();
			$Contacts = $mContact->findAll();
			$Agencies = $mAgency->findAll();
			
			$News = $mNewsGeneral->findByCategoryPage(array($IdCategory, $Page, 8));
			$NewsAll = $mNewsGeneral->findAll();
						
			$PN = new \MVC\Domain\PageNavigation($Category->getNews()->count(), 8, $Category->getURLRead());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Category", $Category);
			$request->setObject("News", $News);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Agencies", $Agencies);
			
			$request->setObject("PN", $PN);
			$request->setProperty("Page", $Page);
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveMenu", 'CategoryGeneral');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>