<?php
	namespace MVC\Command;	
	class AppCChess extends Command {
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
			$mCChess = new \MVC\Mapper\CChess();
			$mCB = new \MVC\Mapper\CBook();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CChess	= $mCChess->find(1);
			$CBAll 	= $mCB->findByTop(array());
			
			$Title	= "HỌC CỜ TƯỚNG";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),				
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CChess', 		$CChess);
			$request->setObject('CBAll', 		$CBAll);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>