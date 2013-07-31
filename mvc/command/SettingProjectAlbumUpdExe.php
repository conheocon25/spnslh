<?php
	namespace MVC\Command;	
	class SettingProjectAlbumUpdExe extends Command{
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
			$IdAlbum = $request->getProperty('IdAlbum');
			$Date = $request->getProperty('Date');			
			$Name = $request->getProperty('Name');
			$URL = $request->getProperty('URL');
			$Description = $request->getProperty('Description');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Album = $mAlbum->find($IdAlbum);						
			$Album->setDate($Date);
			$Album->setName($Name);
			$Album->setURL($URL);
			$Album->setDescription($Description);
			$mAlbum->update($Album);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
						
			return self::statuses('CMD_OK');
		}
	}
?>