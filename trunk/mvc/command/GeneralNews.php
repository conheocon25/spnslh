<?php
	namespace MVC\Command;	
	class GeneralNews extends Command{
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
			$IdNews = $request->getProperty('IdNews');
			
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
			
			$NG = $mNewsGeneral->find($IdNews);
			$NGRelates = $mNewsGeneral->findByCategoryDate(array($IdCategory, $NG->getDate()));
								
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Category", $Category);
			$request->setObject("NG", $NG);
			$request->setObject("NGRelates", $NGRelates);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Agencies", $Agencies);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveMenu", 'CategoryGeneral');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>