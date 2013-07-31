<?php
	namespace MVC\Command;	
	class SettingCategoryKnowledge extends Command{
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
			$Title = "KIẾN THỨC";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting")
			);
			
			$CategoryAdsAll = $mCategoryAds->findAll();
			$CategoryMarketAll = $mCategoryMarket->findAll();
			$CategoryProjectAll = $mCategoryProject->findAll();
			$CategoryGeneralAll = $mCategoryGeneral->findAll();
			$CategoryKnowledgeAll = $mCategoryKnowledge->findAll();
			$CategoryProjectAll = $mCategoryProject->findAll();
			$AgencyAll = $mAgency->findAll();
			$ContactAll = $mContact->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryAdsAll", $CategoryAdsAll);
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("CategoryGeneralAll", $CategoryGeneralAll);
			$request->setObject("CategoryKnowledgeAll", $CategoryKnowledgeAll);
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("AgencyAll", $AgencyAll);
			$request->setObject("ContactAll", $ContactAll);
									
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
			$request->setProperty("ActiveSetting", 'CategoryKnowledge');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>