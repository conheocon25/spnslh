<?php
	namespace MVC\Command;	
	class SettingCSetStepUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCBook 	= $request->getProperty('IdCBook');
			$IdCSet 	= $request->getProperty('IdCSet');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCB 	= new \MVC\Mapper\CBook();
			$mCS 	= new \MVC\Mapper\CSet();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CBAll 		= $mCB->findAll();
			$CB			= $mCB->find($IdCBook);
			$CS			= $mCS->find($IdCSet);
			$Title		= mb_strtoupper($CS->getName(), 'UTF8')." > NƯỚC ĐI";
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("CỜ TƯỚNG", 	"/quan-ly/co-tuong"),
				array(mb_strtoupper($CB->getTitle(), 'UTF8'), $CB->getURLSettingSet())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CBAll', 			$CBAll);
			$request->setObject('CB', 				$CB);
			$request->setObject('CS', 				$CS);
			
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>