<?php
	namespace MVC\Command;	
	class SettingZenMusicInfoLoad extends Command {
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
			$mZenMusic = new \MVC\Mapper\ZenMusic();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$ZenMusic		= $mZenMusic->find(1);
			if (!isset($ZenMusic)){
				$ZenMusic = new \MVC\Domain\ZenMusic(
					null,
					"",
					1
				);
				$mZenMusic->insert($ZenMusic);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("NHẠC THIỀN", "/quan-ly/nhac-thien")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('ZenMusic', 		$ZenMusic);
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingZenMusic');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>