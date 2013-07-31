<?php
	namespace MVC\Command;	
	class SettingAgencyDetail extends Command{
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
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$AgencyAll = $mAgency->findAll();			
			$Agency = $mAgency->find($IdAgency);
						
			if (!isset($Page)) $Page=1;
			$AMs = $mAgencyMarket->findByAgencyPage(array($IdAgency, $Page, 9));
			$PN = new \MVC\Domain\PageNavigation($Agency->getAMs()->count(), 8, $Agency->getURLView());
			
			$Title = mb_strtoupper("THIẾT LẬP / NHÀ MÔI GIỚI / ".$Agency->getName()." / CHI TIẾT",'UTF8');
			$URLBack = "/setting/agency";
			$Title = "NHÀ MÔI GIỚI";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("AgencyAll", $AgencyAll);
			$request->setObject("Agency", $Agency);
			$request->setObject("AMs", $AMs);
			$request->setObject("PN", $PN);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);
			$request->setProperty("Page", $Page);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>