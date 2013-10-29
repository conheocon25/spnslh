<?php		
	namespace MVC\Command;	
	class SettingNews extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Category	= $mCategoryNews->find($IdCategory);
			$CategoryAll= $mCategoryNews->findAll();
			
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP"	, "/setting"),
				array("TIN TỨC"		, "/setting/category/news")
			);
			
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$NewsAll1 = $mNews->findByPage(array($IdCategory, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Category->getNewsAll()->count(), $Config->getValue(), $Category->getURLSettingNews() );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('Page', $Page);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('PN', $PN);
			
			$request->setObject('CategoryAll'	, $CategoryAll);
			$request->setObject('Category'		, $Category);
			$request->setObject('NewsAll1'		, $NewsAll1);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>