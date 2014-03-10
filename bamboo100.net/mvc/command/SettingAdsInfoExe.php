<?php
	namespace MVC\Command;	
	class SettingAdsInfoExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$Introduction	= \stripslashes($request->getProperty('Introduction'));
			$Count 			= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mAds = new \MVC\Mapper\Ads();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$Ads = $mAds->find(1);
			$Ads->setIntroduction($Introduction);			
			$Ads->setCount($Count);
			$mAds->update($Ads);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>