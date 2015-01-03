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
			$mBranch 		= new \MVC\Mapper\Branch();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$BranchAll = $mBranch->findAll();
						
			$Title = "CHI NHÁNH";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$BranchAll1 = $mBranch->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($BranchAll->count(), $Config->getValue(), "/setting/branch" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Branch');
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('BranchAll1'	, $BranchAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>