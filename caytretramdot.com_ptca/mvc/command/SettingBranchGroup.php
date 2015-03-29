<?php
	namespace MVC\Command;	
	class SettingBranchGroup extends Command {
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
			$mBranchGroup 	= new \MVC\Mapper\BranchGroup();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$BranchGroupAll = $mBranchGroup->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$BranchGroupAll1 	= $mBranchGroup->findByPage(array($Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($BranchGroupAll->count(), $Config->getValue(), "/ql-thiet-lap/don-vi-truc-thuoc");
			
			$Title = "ĐƠN VỊ TRỰC THUỘC";
			$Navigation = array(array("THIẾT LẬP", "/ql-thiet-lap"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('BranchGroupAll1'	, $BranchGroupAll1);
			
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>