<?php
	namespace MVC\Command;	
	class SettingAdsUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdAds = $request->getProperty('IdAds');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mAds = new \MVC\Mapper\Ads();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Ad = $mAds->find($IdAds);
			
			$Title = mb_strtoupper("THIẾT LẬP / QUẢNG CÁO / ".$Ad->getName()." / CẬP NHẬT", 'UTF8');
			$URLBack = "/setting/category/ads";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Ad", $Ad);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>