<?php		
	namespace MVC\Command;	
	class SettingCategory extends Command {
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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$CategoryAll = $mCategory->findAll();
						
			$Title = "DANH MỤC MÓN";
			$Navigation = array(			
				array("THIẾT LẬP", "/setting")
			);
			if (!isset($Page)) $Page=1;
			
			$ConfigName = $mConfig->findByName("NAME");
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$CategoryAll1 = $mCategory->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CategoryAll->count(), $Config->getValue(), "/setting/category" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'Category');
			$request->setProperty('Page', 			$Page);
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('CategoryAll1', 	$CategoryAll1);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('PN', 				$PN);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>