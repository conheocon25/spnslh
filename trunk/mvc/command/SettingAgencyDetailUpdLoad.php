<?php
	namespace MVC\Command;	
	class SettingAgencyDetailUpdLoad extends Command{
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
			$CategoryEstates = $mCategoryEstate->findAll();
			
			$Provinces = $mProvince->findAll();
			$Districts = $mDistrict->findAll();			
			$Categories = $mCategoryMarket->findAll();
			$Agency = $mAgency->find($IdAgency);
			$AM = $mAgencyMarket->find($IdAM);
			
			$Title = mb_strtoupper("THIẾT LẬP / NHÀ MÔI GIỚI / ".$Agency->getName()." / CẬP NHẬT TIN", 'UTF8');
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
			$request->setObject("CategoryEstates", $CategoryEstates);
			
			$request->setObject("Provinces", $Provinces);
			$request->setObject("Districts", $Districts);
			$request->setObject("Categories", $Categories);			
			$request->setObject("Agency", $Agency);
			$request->setObject("AM", $AM);
			
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveItem", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>