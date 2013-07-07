<?php
	namespace MVC\Command;	
	class SettingAds extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Title = "THIẾT LẬP / QUẢNG CÁO";
			$URLBack = "/setting/category/ads";
			
			$Category = $mCategoryAds->find($IdCategory);
			$CategoryAll = $mCategoryAds->findAll();
			$AdsAll = $Category->getAdsAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Category", $Category);
			$request->setObject("CategoryAll", $CategoryAll);
			$request->setObject("AdsAll", $AdsAll);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>