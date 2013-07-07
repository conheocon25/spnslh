<?php
	namespace MVC\Command;	
	class SettingCategoryAdsDelLoad extends Command{
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
			$mCategory = new \MVC\Mapper\CategoryAds();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Category = $mCategory->find($IdCategory);
									
			$Title = mb_strtoupper("THIẾT LẬP / ".$Category->getName()." / XÓA", 'UTF8');
			$URLBack = "/setting/category/ads";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", $Category);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
			$request->setProperty("ActiveSetting", 'CategoryGeneral');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>