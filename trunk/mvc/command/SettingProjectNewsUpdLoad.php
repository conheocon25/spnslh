<?php
	namespace MVC\Command;	
	class SettingProjectNewsUpdLoad extends Command{
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
			$IdNews = $request->getProperty('IdNews');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mProject = new \MVC\Mapper\Project();
			$mNewsProject = new \MVC\Mapper\NewsProject();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryGenerals1 = $mCategoryGeneral->findAll();
			
			$Category = $mCategoryProject->find($IdCategory);
			$Project = $mProject->find($IdProject);
			$News = $mNewsProject->find($IdNews);
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Category->getName()." / ".$Project->getTitle()."/".$News->getTitle()." / CẬP NHẬT", 'UTF8');
			$URLBack = $Project->getURLNewsView();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryGenerals1", $CategoryGenerals1);
			$request->setObject("Category", $Category);
			$request->setObject("News", $News);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);			
			$request->setProperty("ActiveItem", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>