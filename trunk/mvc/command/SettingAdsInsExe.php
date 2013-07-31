<?php
	namespace MVC\Command;	
	class SettingAdsInsExe extends Command{
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
			$Name = $request->getProperty('Name');
			$Date = $request->getProperty('Date');
			$Logo = $request->getProperty('Logo');
			$Content = \stripslashes($request->getProperty('Content'));
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------					
			require_once("mvc/base/mapper/MapperDefault.php");
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mAds->insert(new \MVC\Domain\Ads(
				null,
				$IdCategory,
				$Name,
				$Date,				
				$Content,
				$Logo
			));			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>