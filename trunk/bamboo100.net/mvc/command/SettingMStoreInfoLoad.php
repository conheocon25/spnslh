<?php
	namespace MVC\Command;	
	class SettingMStoreInfoLoad extends Command {
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
			$mMStore = new \MVC\Mapper\MStore();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$MStore		= $mMStore->find(1);
			if (!isset($MStore)){
				$MStore = new \MVC\Domain\MStore(
					null,
					"",
					1
				);
				$mMStore->insert($MStore);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 			"/quan-ly"),
				array("QUẢN LÝ TẠP HÓA", 	"/quan-ly/quan-ly-tap-hoa")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('MStore', 			$MStore);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingMStore');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>