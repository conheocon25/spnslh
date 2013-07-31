<?php
	namespace MVC\Command;	
	class SettingAgencyDetailInsLoad extends Command{
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
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$Contacts = $mContact->findAll();
						
			$Categories = $mCategoryMarket->findAll();
			$Provinces = $mProvince->findAll();
			$Districts = $mDistrict->findAll();			
			$Agencies1 = $mAgency->findAll();
			$Agency = $mAgency->find($IdAgency);
						
			$Title = mb_strtoupper("THIẾT LẬP / NHÀ MÔI GIỚI / ".$Agency->getName()." / THÊM TIN RAO", 'UTF8');
			$URLBack = "/setting/agency";
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
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Categories", $Categories);
			$request->setObject("Provinces", $Provinces);
			$request->setObject("Districts", $Districts);
			$request->setObject("Agencies1", $Agencies1);
			$request->setObject("Agency", $Agency);
			
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);
					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>