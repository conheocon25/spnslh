<?php
	namespace MVC\Command;	
	class ASettingRoom extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mRoom 		= new \MVC\Mapper\Room();
			$mConfig 	= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$RoomAll = $mRoom->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$RoomAll1 	= $mRoom->findByPage(array($Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation($RoomAll->count(), $Config->getValue(), "/setting/Room");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);									
			$request->setObject('RoomAll1'	, $RoomAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>