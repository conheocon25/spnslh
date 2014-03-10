<?php
	namespace MVC\Command;	
	class SettingKaraokeInfoLoad extends Command{
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
			$mKaraoke = new \MVC\Mapper\Karaoke();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$Karaoke		= $mKaraoke->find(1);
			if (!isset($Karaoke)){
				$Karaoke = new \MVC\Domain\Karaoke(
					null,
					"",
					1
				);
				$mKaraoke->insert($Karaoke);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 			"/quan-ly"),
				array("QUẢN LÝ KARAOKE", 	"/quan-ly/quan-ly-karaoke")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Karaoke', 			$Karaoke);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingKaraoke');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>