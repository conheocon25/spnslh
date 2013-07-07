<?php
	namespace MVC\Command;	
	class SettingProjectAlbumDelLoad extends Command{
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
			$IdAlbum = $request->getProperty('IdAlbum');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategory = new \MVC\Mapper\CategoryProject();
			$mProject = new \MVC\Mapper\Project();
			$mProjectAlbum = new \MVC\Mapper\ProjectAlbum();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Category = $mCategory->find($IdCategory);
			$Project = $mProject->find($IdProject);
			$Album = $mProjectAlbum->find($IdAlbum);
			$Title = mb_strtoupper("THIẾT LẬP / DỰ ÁN / ".$Category->getName()." / ".$Project->getTitle()."/".$Album->getName()." / XÓA", 'UTF8');
			$URLBack = $Project->getURLAlbumSetting();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("Category", $Category);
			$request->setObject("Project", $Project);
			$request->setObject("Album", $Album);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>