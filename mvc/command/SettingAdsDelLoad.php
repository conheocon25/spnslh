<?php
	namespace MVC\Command;	
	class SettingAdsDelLoad extends Command{
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
			require_once("mvc/base/mapper/MapperDefault.php");
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Ad = $mAds->find($IdAds);
			
			$Title = mb_strtoupper("THIẾT LẬP / QUẢNG CÁO / ".$Ad->getName()." / XÓA", 'UTF8');
			$URLBack = "/setting/ads";
			$Title = "NHÀ MÔI GIỚI";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Ad", $Ad);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>