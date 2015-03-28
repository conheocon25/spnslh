<?php
	namespace MVC\Command;	
	class SettingGoodGroup extends Command {
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
			$mGoodGroup 	= new \MVC\Mapper\GoodGroup();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$GoodGroupAll = $mGoodGroup->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$GoodGroupAll1 	= $mGoodGroup->findByPage(array($Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($GoodGroupAll->count(), $Config->getValue(), "/admin/setting/group");
			
			$Title = "HÀNG HÓA";
			$Navigation = array(array("THIẾT LẬP", "/ql-thiet-lap"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('GoodGroupAll1'		, $GoodGroupAll1);
			
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>