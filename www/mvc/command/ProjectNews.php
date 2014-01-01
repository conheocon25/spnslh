<?php
	namespace MVC\Command;	
	class ProjectNews extends Command {
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
			$NKey = $request->getProperty("NKey");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");

			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$AllCategoryNews = $mCategoryNews->findAll();
			$Project = $mProject->findByKey($Key);
			$AllNews = $mPNews->findAll();
			
			if(isset($NKey)) {
				$NewsRead = $mPNews->findByKey($NKey);
			} else {
				$NewsRead = $mPNews->getFirst();
			}
			
			$Navigation = array(				
				array("Dự án", "/du-an"),
				array($Project->getName(), $Project->getURLView())
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Project->getName());
			$request->setProperty('EndBcrumb', 'Tin tức');
			$request->setProperty('ActiveTopMenu', 'Project');
			$request->setProperty('ActiveLeftMenu', 'ProjectNews');
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			$request->setObject('AllNews', $AllNews);
			$request->setObject('NewsRead', $NewsRead);
			$request->setObject('Project', $Project);
			$request->setObject('Navigation', $Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>