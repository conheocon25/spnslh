<?php
	namespace MVC\Command;	
	class SettingMarket extends Command{
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
			$Category = $mCategoryMarket->find($IdCategory);
			
			if (!isset($Page)) $Page=1;
			$NewsAll = $mNewsMarket->findByCategoryPage(array($IdCategory, $Page, 9));
			$PN = new \MVC\Domain\PageNavigation($Category->getNews()->count(), 8, $Category->getURLView());
						
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting"),
				array("TIN ĐĂNG", "/setting/category/market")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", $Category);
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);
			$request->setObject("NewsAll", $NewsAll);
			$request->setObject("PN", $PN);
			$request->setObject("Navigation", $Navigation);	
			$request->setProperty("Title", $Title);
					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>