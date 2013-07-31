<?php
	namespace MVC\Command;	
	class SettingAdsUpdExe extends Command{
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
			$Ad = $mAds->find($IdAds);
			$Ad->setName($Name);
			$Ad->setDate($Date);
			$Ad->setLogo($Logo);
			$Ad->setContent($Content);			
			$mAds->update($Ad);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');
		}
	}
?>