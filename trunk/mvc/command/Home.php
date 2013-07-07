<?php
	namespace MVC\Command;	
	class Home extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Website Nhà đất Sài Gòn";
			
			$CategoryGeneralAll = $mCategoryGeneral->findAll();
			$CategoryMarketAll = $mCategoryMarket->findAll();			
			$CategoryProjectAll = $mCategoryProject->findAll();
			$CategoryEstateAll = $mCategoryEstate->findAll();
			$CategoryKnowledgeAll = $mCategoryKnowledge->findAll();						
			$AgencyAll = $mAgency->findAll();			
			$ContactAll = $mContact->findAll();
			
			$ProjectTopAll = $mProject->findVIP(null);
			$NMAll = $mNewsMarket->findAll();
			$NMTopAll = $mNewsMarket->findByPage(array(1, 6));
			$NGAll = $mNewsGeneral->findAll();
			$NGTopAll = $mNewsGeneral->findByPage(array(1, 7));			
			$AdsAll = $mAds->findBy(array(2));
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGeneralAll", $CategoryGeneralAll);
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);			
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("CategoryEstateAll", $CategoryEstateAll);
			$request->setObject("CategoryKnowledgeAll", $CategoryKnowledgeAll);			
						
			$request->setObject("AgencyAll", $AgencyAll);			
			$request->setObject("ContactAll", $ContactAll);
			$request->setObject("AdsAll", $AdsAll);
			
			$request->setObject("ProjectTopAll", $ProjectTopAll);
			$request->setObject("NMAll", $NMAll);
			$request->setObject("NMTopAll", $NMTopAll);
			$request->setObject("NGAll", $NGAll);
			$request->setObject("NGTopAll", $NGTopAll);			
						
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveMenu", 'Home');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>