<?php		
	namespace MVC\Command;	
	class SettingCategoryNews extends Command {
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
			$CategoryNewsAll = $mCategoryNews->findAll();			
						
			$Title = "TIN TỨC";
			$Navigation = array(				
				array("THIẾT LẬP", "/setting")
			);
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$CategoryNewsAll1 = $mCategoryNews->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CategoryNewsAll->count(), $Config->getValue(), "/setting/category/news" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('Page', $Page);
			$request->setProperty('ActiveAdmin', 'News');
			$request->setObject('Navigation', $Navigation);
			$request->setObject('PN', $PN);
			
			$request->setObject('CategoryNewsAll1', $CategoryNewsAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>