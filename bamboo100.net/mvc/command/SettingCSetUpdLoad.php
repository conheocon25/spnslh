<?php
	namespace MVC\Command;	
	class SettingCSetUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
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
			$CB 	= $mCB->find($IdCBook);
			$CS 	= $mCS->find($IdCSet);
						
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),				
				array("CỜ TƯỚNG", 	"/quan-ly/hoc-co-tuong"),
				array(mb_strtoupper($CB->getTitle(), 'UTF8'), $CB->getURLSettingSet())
			);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'CB', 			$CB );
			$request->setObject( 'CS', 			$CS );
			$request->setObject( 'Navigation', 	$Navigation );
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setProperty("Title", 		mb_strtoupper($CS->getName(), 'UTF8')." > CẬP NHẬT");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
