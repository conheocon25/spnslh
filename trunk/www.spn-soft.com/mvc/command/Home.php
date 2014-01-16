<?php
	namespace MVC\Command;	
	class Home extends Command{
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
			$mTechnical = new \MVC\Mapper\Technical();
			$mSolution = new \MVC\Mapper\Solution();
			$mService = new \MVC\Mapper\Service();
			$mProject = new \MVC\Mapper\Project();
			$mCustomerStory = new \MVC\Mapper\CustomerStory();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "HỆ THỐNG 123APP.NET";
			$Technicals = $mTechnical->findAll();
			$Solutions = $mSolution->findAll();
			$Services = $mService->findAll();
			$Projects = $mProject->findAll();
			$CustomerStories = $mCustomerStory->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty("Title", $Title);
			$request->setObject("Technicals", $Technicals);
			$request->setObject("Solutions", $Solutions);
			$request->setObject("Services", $Services);
			$request->setObject("Projects", $Projects);
			$request->setObject("CustomerStories", $CustomerStories);
			
			$request->setProperty("ActiveItem", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>