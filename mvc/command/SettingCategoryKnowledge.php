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
			$Title = "THIẾT LẬP / DANH MỤC KIẾN THỨC";
			$URLBack = "/setting";
			
			$CategoryMarketAll = $mCategoryMarket->findAll();
			$CategoryProjectAll = $mCategoryProject->findAll();
			$CategoryGeneralAll = $mCategoryGeneral->findAll();
			$CategoryKnowledgeAll = $mCategoryKnowledge->findAll();
			$AgencyAll = $mAgency->findAll();
			$ContactAll = $mContact->findAll();
			$CategoryKnowledgeAll1 = $mCategoryKnowledge->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("CategoryGeneralAll", $CategoryGeneralAll);
			$request->setObject("CategoryKnowledgeAll", $CategoryKnowledgeAll);
			$request->setObject("CategoryKnowledgeAll1", $CategoryKnowledgeAll1);
			$request->setObject("AgencyAll", $AgencyAll);
			$request->setObject("ContactAll", $ContactAll);
									
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);
			$request->setProperty("ActiveSetting", 'CategoryKnowledge');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>