<?php
	namespace MVC\Command;	
	class AppCBook extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KIdBook = $request->getProperty('KIdBook');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCB = new \MVC\Mapper\CBook();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CBAll 	= $mCB->findAll();
			$CB 	= $mCB->findByKey($KIdBook);
			$Title	= mb_strtoupper($CB->getTitle(), 'UTF8');
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("CỜ TƯỚNG", "/ung-dung/co-tuong")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CBAll', 	$CBAll);
			$request->setObject('CB', 		$CB);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>