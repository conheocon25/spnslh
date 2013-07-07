<?php
	namespace MVC\Command;	
	class Project extends Command{
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
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mProject = new \MVC\Mapper\Project();
			$mContact = new \MVC\Mapper\Contact();
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Category = $mCategoryProject->find($IdCategory);
			$Title = $Category->getName();
			
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			
			$Projects = $mProject->findAll();
			$Contacts = $mContact->findAll();
			$Agencies = $mAgency->findAll();
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Category", $Category);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Agencies", $Agencies);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveMenu", 'CategoryProject');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>