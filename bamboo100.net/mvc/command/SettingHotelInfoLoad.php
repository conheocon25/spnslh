<?php
	namespace MVC\Command;	
	class SettingHotelInfoLoad extends Command{
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
			$mHotel = new \MVC\Mapper\Hotel();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$Hotel		= $mHotel->find(1);
			if (!isset($Hotel)){
				$Hotel = new \MVC\Domain\Hotel(
					null,
					"",
					1
				);
				$mHotel->insert($Hotel);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 			"/quan-ly"),
				array("QUẢN LÝ KHÁCH SẠN", 	"/quan-ly/quan-ly-khach-san")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Hotel', 			$Hotel);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingHotel');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>