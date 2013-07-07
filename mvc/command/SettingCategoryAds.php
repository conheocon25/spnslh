<?php
	namespace MVC\Command;	
	class SettingCategoryAds extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryAds = new \MVC\Mapper\CategoryAds();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "THIẾT LẬP / QUẢNG CÁO";
			$URLBack = "/setting";
			
			$CategoryAdsAll = $mCategoryAds->findAll();
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryAdsAll", $CategoryAdsAll);
														
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);			
			$request->setProperty("ActiveSetting", 'CategoryAds');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>