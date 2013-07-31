<?php
	namespace MVC\Command;	
	class SettingAgencyDetailDelLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
								
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryGenerals = $mCategoryGeneral->findAll();
			
			$Categories = $mCategoryMarket->findAll();
			$Agencies1 = $mAgency->findAll();
			$Agency = $mAgency->find($IdAgency);
			$AM = $mAgencyMarket->find($IdAM);
			
			$Title = mb_strtoupper("THIẾT LẬP / NHÀ MÔI GIỚI / ".$Agency->getName()." / XÓA TIN RAO", 'UTF8');
			$URLBack = $Agency->getURLView();
			$Title = "NHÀ MÔI GIỚI";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryGenerals", $CategoryGenerals);						
			
			$request->setObject("Categories", $Categories);
			$request->setObject("Agencies1", $Agencies1);
			$request->setObject("Agency", $Agency);
			$request->setObject("AM", $AM);
			$request->setObject("Navigation", $Navigation);	
			$request->setProperty("Title", $Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>