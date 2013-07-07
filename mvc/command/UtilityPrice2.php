<?php
	namespace MVC\Command;	
	class UtilityPrice2 extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "HỆ THỐNG 123APP.NET";
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveItem", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>