<?php
	namespace MVC\Command;	
	class SettingMRestaurantInfoLoad extends Command {
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
			$mMRestaurant = new \MVC\Mapper\MRestaurant();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title			= "THÔNG TIN";
			$MRestaurant	= $mMRestaurant->find(1);
			if (!isset($MRestaurant)){
				$MRestaurant = new \MVC\Domain\MRestaurant(
					null,
					"",
					1
				);
				$mMRestaurant->insert($MRestaurant);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("QUÁN ĂN", 	"/quan-ly/quan-ly-quan-an")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('MRestaurant', 		$MRestaurant);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingMRestaurant');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>