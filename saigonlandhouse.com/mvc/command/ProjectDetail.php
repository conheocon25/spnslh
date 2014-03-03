<?php
	namespace MVC\Command;	
	class ProjectDetail extends Command {
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

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$AllCategoryNews = $mCategoryNews->findAll();
			$Project = $mProject->findByKey($Key);
			
			$Navigation = array(				
				array("Dự án", "/du-an"),
				array($Project->getName(), $Project->getURLView())
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Project->getName());
			$request->setProperty('EndBcrumb', 'Thông tin');
			$request->setProperty('ActiveTopMenu', 'Project');
			$request->setProperty('ActiveLeftMenu', 'Project');
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			$request->setObject('Project', $Project);
			$request->setObject('Navigation', $Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>