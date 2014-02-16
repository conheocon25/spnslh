<?php
	namespace MVC\Command;	
	class ReadCategory extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Key = $request->getProperty('Key');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Page)) $Page = 1;
			
			$AllCategoryNews = $mCategoryNews->findAll();
			$Category = $mCategoryNews->findByKey($Key);
			
			$NewsAll = $mNews->findByCategoryPage(array($Category->getId(), $Page, 10));
			$PN = new \MVC\Domain\PageNavigation($Category->getNewsAll()->count(), 10, $Category->getURLReadNews());
			
			$Navigation = array(
				array("Tin tức", "/tin-tuc")
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Category->getName());
			$request->setProperty('ActiveTopMenu', 'News');
			$request->setProperty('ActiveLeftMenu', $Category->getId());
			$request->setObject('Navigation', $Navigation);
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			$request->setObject('Category', $Category);
			$request->setObject('NewsAll', $NewsAll);
			$request->setObject("PN", $PN);
			$request->setProperty("Page", $Page);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>