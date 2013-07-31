<?php
	namespace MVC\Command;	
	class SettingAgencyDetailUpdExe extends Command{
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
			$IdAM = $request->getProperty('IdAM');
			$IdCategory = $request->getProperty('IdCategory');
			$IdEstate = $request->getProperty('IdEstate');
			$Price = $request->getProperty('Price');			
			$IdDistrict = $request->getProperty('IdDistrict');
			$Date = $request->getProperty('Date');
			$Content = \stripslashes($request->getProperty('Content'));
			$Title = $request->getProperty('Title');
			$Type = $request->getProperty('Type');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------											
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$AM = $mAgencyMarket->find($IdAM);
			$District = $mDistrict->find($IdDistrict);
			$News = $AM->getNews();
						
			$Type = ($Type=="on"?1:0);
			
			$News->setIdCategory($IdCategory);
			$News->setIdEstate($IdEstate);
			$News->setPrice($Price);
			$News->setIdProvince($District->getIdProvince());
			$News->setIdDistrict($IdDistrict);
			$News->setContent($Content);
			$News->setDate($Date);
			$News->setTitle($Title);
			$News->setType($Type);
			$mNewsMarket->update($News);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
