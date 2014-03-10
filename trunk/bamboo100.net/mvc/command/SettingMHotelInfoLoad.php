<?php
	namespace MVC\Command;	
	class SettingMHotelInfoLoad extends Command{
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
			$mMHotel = new \MVC\Mapper\MHotel();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$MHotel		= $mMHotel->find(1);
			if (!isset($MHotel)){
				$MHotel = new \MVC\Domain\MHotel(
					null,
					"",
					1
				);
				$mMHotel->insert($MHotel);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 			"/quan-ly"),
				array("QUẢN LÝ NHÀ TRỌ", 	"/quan-ly/quan-ly-nha-tro")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('MHotel', 			$MHotel);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingMHotel');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>