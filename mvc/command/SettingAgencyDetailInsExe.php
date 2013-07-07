<?php
	namespace MVC\Command;	
	class SettingAgencyDetailInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdAgency = $request->getProperty('IdAgency');
			$IdCategory = $request->getProperty('IdCategory');
			$IdEstate = $request->getProperty('IdCategoryEstate');			
			$Price = $request->getProperty('Price');
			//$IdProvince = $request->getProperty('cboCity');
			$IdDistrict = $request->getProperty('IdDistrict');
			$Date = $request->getProperty('Date');
			$Content = \stripslashes($request->getProperty('Content'));
			$Title = $request->getProperty('Title');
			$Type = $request->getProperty('Type');
			$X = $request->getProperty('latitude');
			$Y = $request->getProperty('longitude');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------											
			$mAgencyMarket = new \MVC\Mapper\AgencyMarket();
			$mNews = new \MVC\Mapper\NewsMarket();
			$mDistrict = new \MVC\Mapper\District();
			$District = $mDistrict->find($IdDistrict);
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			if ($Type=="on") $Type=1; else $Type=0;
				
			$News = new \MVC\Domain\NewsMarket(
				null,
				$IdCategory,
				$IdEstate,
				$Price,
				$District->getIdProvince(),
				$IdDistrict,
				$Date,
				$Content,
				$Title,
				$Type,
				$X,
				$Y
			);
			$mNews->insert($News);									
			$AM = new \MVC\Domain\AgencyMarket(
				null,
				$IdAgency,
				$News->getId(),
				0
			);
			$mAgencyMarket->insert($AM);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
