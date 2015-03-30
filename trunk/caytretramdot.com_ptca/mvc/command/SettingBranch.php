<?php
	namespace MVC\Command;	
	class SettingBranch extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 		= $request->getProperty('Page');
			$IdGroup 	= $request->getProperty('IdGroup');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mBranch 		= new \MVC\Mapper\Branch();
			$mBranchGroup 	= new \MVC\Mapper\BranchGroup();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Group 			= $mBranchGroup->find($IdGroup);
			$GroupAll 		= $mBranchGroup->findAll();			
			$BranchAll 		= $mBranch->findByGroup(array($IdGroup));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$BranchAll1 	= $mBranch->findByGroupPage(array($IdGroup, $Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($BranchAll->count(), $Config->getValue(), $Group->getURLSetting() );
			
			$Title = mb_strtoupper($Group->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("ĐƠN VỊ", "/ql-thiet-lap/don-vi-truc-thuoc")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('Group'				, $Group);
			$request->setObject('GroupAll'			, $GroupAll);
			$request->setObject('BranchAll1'		, $BranchAll1);
			
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>