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
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryEstate = new \MVC\Mapper\CategoryEstate();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mContact = new \MVC\Mapper\Contact();
			$mProvince = new \MVC\Mapper\Province();
			$mDistrict = new \MVC\Mapper\District();
			$mAgency = new \MVC\Mapper\Agency();
											
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
						
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
			$request->setProperty("ActiveItem", 'Home');
			$request->setProperty("ActiveMenu", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>