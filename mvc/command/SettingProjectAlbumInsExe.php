<?php
	namespace MVC\Command;	
	class SettingProjectAlbumInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$IdProject = $request->getProperty('IdProject');
			$Name = $request->getProperty('Name');
			$Date = $request->getProperty('Date');
			$URL = $request->getProperty('URL');
			$Description = $request->getProperty('Description');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			if (!isset($Name))
				return self::statuses('CMD_OK');
							
			$Album = new \MVC\Domain\ProjectAlbum(
				null,
				$IdProject,
				$Name,
				$Date,
				$URL,
				$Description
			);
			$mAlbum->insert($Album);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
						
			return self::statuses('CMD_OK');
		}
	}
?>
