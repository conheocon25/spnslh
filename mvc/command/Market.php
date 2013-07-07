<?php
	namespace MVC\Command;	
	class Market extends Command{
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
			$mCategoryEstate = new \MVC\Mapper\CategoryEstate();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mNewsMarket = new \MVC\Mapper\NewsMarket();
			$mProject = new \MVC\Mapper\Project();
			$mContact = new \MVC\Mapper\Contact();
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Web site nhà đất / tin rao vặt";
			$Category = $mCategoryMarket->find($IdCategory);
								
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryMarkets1 = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();			
			$CategoryEstates = $mCategoryEstate->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Projects = $mProject->findAll();
			$Contacts = $mContact->findAll();
			$Agencies = $mAgency->findAll();
			
			$News = $mNewsMarket->findByCategoryPage(array($IdCategory, $Page, 8));
			$NewsAll = $mNewsMarket->findAll();
						
			$PN = new \MVC\Domain\PageNavigation($Category->getNews()->count(), 8, $Category->getURLRead());
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("PN", $PN);
			$request->setObject("Category", $Category);
			$request->setObject("News", $News);
			$request->setObject("NewsAll", $NewsAll);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryMarkets1", $CategoryMarkets1);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryEstates", $CategoryEstates);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Agencies", $Agencies);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("Page", $Page);
			$request->setProperty("ActiveMenu", 'CategoryMarket');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>