<?php
	namespace MVC\Command;	
	class SigninLoad extends Command {
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
			$mCategoryEstate = new \MVC\Mapper\CategoryEstate();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mNewsMarket = new \MVC\Mapper\NewsMarket();
			$mNewsGeneral = new \MVC\Mapper\NewsGeneral();
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Đăng nhập nhà môi giới";
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();			
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryEstates = $mCategoryEstate->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);			
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryEstates", $CategoryEstates);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", "/home");
			$request->setProperty("ActiveMenu", 'Home');
			$request->setProperty("ActiveSetting", 'Home');
		}
	}
?>