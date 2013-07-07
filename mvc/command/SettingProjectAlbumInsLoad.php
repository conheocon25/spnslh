<?php
	namespace MVC\Command;	
	class SettingProjectAlbumInsLoad extends Command{
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
			$mCategory = new \MVC\Mapper\CategoryProject();
			$mProject = new \MVC\Mapper\Project();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Category = $mCategory->find($IdCategory);
			$Project = $mProject->find($IdProject);
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Category->getName()."/".$Project->getTitle()." / THÊM ALBUM", 'UTF8');
			$URLBack = $Project->getURLAlbumSetting();
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Project", $Project);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);			
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>