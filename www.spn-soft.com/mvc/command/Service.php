<?php
	namespace MVC\Command;	
	class Service extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdService = $request->getProperty('IdService');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTechnical = new \MVC\Mapper\Technical();
			$mSolution = new \MVC\Mapper\Solution();
			$mService = new \MVC\Mapper\Service();
			$mCustomerStory = new \MVC\Mapper\CustomerStory();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "HỆ THỐNG 123APP.NET";
			$Service = $mService->find($IdService);
			
			$Technicals = $mTechnical->findAll();
			$Solutions = $mSolution->findAll();
			$Services = $mService->findAll();
			$CustomerStories = $mCustomerStory->findAll();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty("Title", $Title);
			$request->setObject("Service", $Service);
			
			$request->setObject("Technicals", $Technicals);
			$request->setObject("Solutions", $Solutions);
			$request->setObject("Services", $Services);
			$request->setObject("CustomerStories", $CustomerStories);
			
			$request->setProperty("ActiveItem", 'Service');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>