<?php
	namespace MVC\Command;	
	class SettingCategoryMarket extends Command{
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
			$Title = "THIẾT LẬP / DANH MỤC TIN ĐỊA ỐC";
			$URLBack = "/setting";
			
			$CategoryGeneralAll = $mCategoryGeneral->findAll();
			$CategoryMarketAll = $mCategoryMarket->findAll();
			$CategoryProjectAll = $mCategoryProject->findAll();
			$AgencyAll = $mAgency->findAll();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGeneralAll", $CategoryGeneralAll);
			$request->setObject("CategoryMarketAll", $CategoryMarketAll);
			$request->setObject("CategoryProjectAll", $CategoryProjectAll);
			$request->setObject("AgencyAll", $AgencyAll);						
			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLBack", $URLBack);			
			$request->setProperty("ActiveSetting", 'CategoryMarket');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>