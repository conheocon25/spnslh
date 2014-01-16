<?php
	namespace MVC\Command;
	//use MVC\Library\QRCodeExt;
	require_once("mvc/base/Library.php");
	
	class UtilityQRCodeExe extends Command{
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
			
			$level = $request->getProperty("level");
			$data = $request->getProperty("data");
			$size = $request->getProperty("size");
			
			$QRCode = new \QRCodeExt($level, $size, $data);
			//$QRCode->creatQRCodeImage();
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
			
			$request->setObject("QRCode", $QRCode);
			
			$request->setProperty("ActiveItem", 'Utility');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>