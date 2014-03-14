<?php
	namespace MVC\Command;	
	class SettingCChessUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCBook = $request->getProperty('IdCBook');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCB = new \MVC\Mapper\CBook();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CB 	= $mCB->find($IdCBook);
			
			$Navigation = array(				
				array("QUẢN LÝ", 	"/quan-ly"),				
				array("CỜ TƯỚNG", 	"/quan-ly/hoc-co-tuong")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'CB', 			$CB );
			$request->setObject( 'Navigation', 	$Navigation );
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setProperty("Title", 		$CB->getTitle()." > CẬP NHẬT");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
