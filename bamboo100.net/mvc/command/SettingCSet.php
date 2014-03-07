<?php
	namespace MVC\Command;	
	class SettingCSet extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCBook = $request->getProperty('IdCBook');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCB = new \MVC\Mapper\CBook();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CBAll 		= $mCB->findAll();
			$CB			= $mCB->find($IdCBook);
			$Title		= mb_strtoupper($CB->getTitle(), 'UTF8')." > VÁN CỜ";
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("CỜ TƯỚNG", 	"/quan-ly/hoc-co-tuong")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CBAll', 			$CBAll);
			$request->setObject('CB', 				$CB);
			
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>