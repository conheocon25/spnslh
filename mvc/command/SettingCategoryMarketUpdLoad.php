<?php
	namespace MVC\Command;	
	class SettingCategoryMarketUpdLoad extends Command{
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
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Category = $mCategoryMarket->find($IdCategory);
			$Title = "THIẾT LẬP / TIN RAO / ".$Category->getName()." / CẬP NHẬT";
			$URLBack = "/setting/category/market";
			
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			
			$CategoryMarkets1 = $mCategoryMarket->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			
			$request->setObject("Category", $Category);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
			$request->setProperty("ActiveItem", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>