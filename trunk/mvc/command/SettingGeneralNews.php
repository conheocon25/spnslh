<?php
	namespace MVC\Command;	
	class SettingGeneralNews extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryMarketAll = $mCategoryMarket->findAll();
			$CategoryProjectAll = $mCategoryProject->findAll();
			$CategoryGeneralAll = $mCategoryGeneral->findAll();						
			$Category = $mCategoryGeneral->find($IdCategory);
			
			$Title = mb_strtoupper("THIẾT LẬP / TIN CHUNG / ".$Category->getName(), 'UTF8');
			$URLBack = "/setting/category/general";
			$Title = "NHÀ MÔI GIỚI";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$News = $mNewsGeneral->findByCategoryPage(array($IdCategory, $Page, 9));
			$PN = new \MVC\Domain\PageNavigation($Category->getNews()->count(), 8, $Category->getURLView());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("CategoryGeneralAll", $CategoryGeneralAll);						
			$request->setObject("Category", $Category);
			$request->setObject("News", $News);
			$request->setObject("PN", $PN);
			
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);
			$request->setProperty("Page", $Page);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>