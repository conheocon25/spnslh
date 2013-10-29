<?php		
	namespace MVC\Command;	
	class SettingProjectDocument extends Command {
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
			
			$Title = mb_strtoupper($Project->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP"	, "/setting"),
				array("DỰ ÁN"		, "/setting/project")
			);
			
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$DocumentAll1 = $mPDocument->findByPage(array($IdProject, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Project->getDocumentAll()->count(), $Config->getValue(), $Project->getURLSettingDocument() );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('Page', $Page);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('PN', $PN);
			
			$request->setObject('Project'		, $Project);
			$request->setObject('ProjectAll'	, $ProjectAll);			
			$request->setObject('DocumentAll1'	, $DocumentAll1);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>