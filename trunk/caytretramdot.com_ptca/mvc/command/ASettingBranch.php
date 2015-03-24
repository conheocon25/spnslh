<?php
	namespace MVC\Command;	
	class ASettingBranch extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mBranch 	= new \MVC\Mapper\Branch();
			$mConfig 	= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$BranchAll = $mBranch->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$BranchAll1 	= $mBranch->findByPage(array($Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($BranchAll->count(), $Config->getValue(), "/admin/setting/branch");
			
			$Title = "CHI NHÁNH";
			$Navigation = array(array("THIẾT LẬP", "/admin"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('BranchAll1'		, $BranchAll1);
			
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>