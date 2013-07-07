<?php
	namespace MVC\Command;	
	class SettingProjectUpdLoad extends Command{
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
			$IdProject = $request->getProperty('IdProject');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mProject = new \MVC\Mapper\Project();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryProjects1 = $mCategoryProject->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Category = $mCategoryProject->find($IdCategory);
			$Project = $mProject->find($IdProject);
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Category->getName()." / ".$Project->getTitle()." / CẬP NHẬT",'UTF8');
			$URLBack = $Category->getURLView();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryProjects1", $CategoryProjects1);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			
			$request->setObject("Category", $Category);
			$request->setObject("Project", $Project);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);						
			$request->setProperty("ActiveMenu", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>