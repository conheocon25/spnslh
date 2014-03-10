<?php
	namespace MVC\Command;	
	class SettingAdsInfoLoad extends Command {
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
			$mAds = new \MVC\Mapper\Ads();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$Ads		= $mAds->find(1);
			if (!isset($Ads)){
				$Ads = new \MVC\Domain\Ads(
					null,
					"",
					1
				);
				$mAds->insert($Ads);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("RAO VẶT", 	"/quan-ly/rao-vat")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Ads', 				$Ads);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingAds');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>