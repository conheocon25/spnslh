<?php
	namespace MVC\Command;	
	class SettingProjectNews extends Command{
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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
									
			$Category = $mCategoryProject->find($IdCategory);
			$ProjectAll = $Category->getProjects();
			$Project = $mProject->find($IdProject);
			
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Project->getTitle()." / TIN TỨC", 'UTF8');
			$URLBack = $Category->getURLView();
			$Title = "NHÀ MÔI GIỚI";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Project", $Project);
			$request->setObject("ProjectAll", $ProjectAll);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>