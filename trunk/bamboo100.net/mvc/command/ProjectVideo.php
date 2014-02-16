<?php
	namespace MVC\Command;	
	class ProjectVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Key = $request->getProperty("Key");
			$VKey = $request->getProperty("VKey");

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$AllCategoryNews = $mCategoryNews->findAll();
			$Project = $mProject->findByKey($Key);
			$AllVideo = $Project->getVideoAll();
			
			if(isset($VKey)) {
				$VideoPlaying = $mPVideo->findByKey($VKey);
			} else {
				$VideoPlaying = $Project->getFirstVideo();
			}
			
			$Navigation = array(				
				array("Dự án", "/du-an"),
				array($Project->getName(), $Project->getURLView())
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Project->getName());
			$request->setProperty('EndBcrumb', 'Video');
			$request->setProperty('ActiveTopMenu', 'Project');
			$request->setProperty('ActiveLeftMenu', 'ProjectVideo');
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			$request->setObject('Project', $Project);
			$request->setObject('AllVideo', $AllVideo);
			$request->setObject('VideoPlaying', $VideoPlaying);
			$request->setObject('Navigation', $Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>