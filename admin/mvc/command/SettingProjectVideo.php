<?php		
	namespace MVC\Command;	
	class SettingProjectVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdProject 	= $request->getProperty('IdProject');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ProjectAll = $mProject->findAll();
			$Project	= $mProject->find($IdProject);
			
			$Title = "VIDEO ".mb_strtoupper($Project->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP"	, "/setting"),
				array("DỰ ÁN"		, "/setting/project")
			);
			
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$VideoAll1 = $mPVideo->findByPage(array($IdProject, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Project->getVideoAll()->count(), $Config->getValue(), $Project->getURLSettingVideo() );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('Page', $Page);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('PN', $PN);
			
			$request->setObject('Project'		, $Project);
			$request->setObject('ProjectAll'	, $ProjectAll);			
			$request->setObject('VideoAll1'	, $VideoAll1);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>