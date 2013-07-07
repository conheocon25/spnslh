<?php
	namespace MVC\Command;	
	class SettingProjectAlbum extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryProject = new \MVC\Mapper\CategoryProject();						
			$mProject = new \MVC\Mapper\Project();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
									
			$Category = $mCategoryProject->find($IdCategory);
			$ProjectAll = $Category->getProjects();
			$Project = $mProject->find($IdProject);
			
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Project->getTitle()." / ALBUM", 'UTF8');
			$URLBack = $Category->getURLView();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Project", $Project);
			$request->setObject("ProjectAll", $ProjectAll);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>