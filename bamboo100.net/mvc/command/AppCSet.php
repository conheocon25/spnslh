<?php
	namespace MVC\Command;	
	class AppCSet extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KIdBook 	= $request->getProperty('KIdBook');
			$KIdSet 	= $request->getProperty('KIdSet');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCB = new \MVC\Mapper\CBook();
			$mCS = new \MVC\Mapper\CSet();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title	= "CỜ TƯỚNG";			
			$CB 	= $mCB->findByKey($KIdBook);
			$CS 	= $mCS->findByKey($KIdSet);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CS', 	$CS);
			$request->setObject('CB', 	$CB);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>