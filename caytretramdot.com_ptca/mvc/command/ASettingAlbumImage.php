<?php		
	namespace MVC\Command;	
	class ASettingAlbumImage extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdAlbum = $request->getProperty('IdAlbum');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mAlbum 	= new \MVC\Mapper\Album();
			$mImage 	= new \MVC\Mapper\Image();
			$mConfig 	= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$AlbumAll 	= $mAlbum->findAll();
			$Album 		= $mAlbum->find($IdAlbum);
			$ImageAll 	= $mImage->findBy(array($IdAlbum));
			
			$Title = mb_strtoupper($Album->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("ALBUM", 		"/admin/setting/album")
			);			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
					
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('Album'			, $Album);
			$request->setObject('AlbumAll'		, $AlbumAll);
			$request->setObject('ImageAll'		, $ImageAll);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>