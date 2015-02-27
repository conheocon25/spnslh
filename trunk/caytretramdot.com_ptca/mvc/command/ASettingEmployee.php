<?php
	namespace MVC\Command;	
	class ASettingEmployee extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdRoom	= $request->getProperty('IdRoom');
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mEmployee 	= new \MVC\Mapper\Employee();
			$mRoom 		= new \MVC\Mapper\Room();
			$mConfig 	= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$RoomAll		= $mRoom->findAll();
			$Room			= $mRoom->find($IdRoom);
			$EmployeeAll 	= $mEmployee->findByRoom(array($IdRoom));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$EmployeeAll1 	= $mEmployee->findByRoomPage(array($IdRoom, $Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($EmployeeAll->count(), $Config->getValue(), "/setting/employee");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('Room'			, $Room);
			$request->setObject('RoomAll'		, $RoomAll);
			$request->setObject('EmployeeAll1'	, $EmployeeAll1);
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>