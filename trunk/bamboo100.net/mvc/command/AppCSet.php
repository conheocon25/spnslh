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
			$CB 	= $mCB->findByKey($KIdBook);
			$CS 	= $mCS->findByKey($KIdSet);
			
			$CS->setCount($CS->getCount()+1);
			$mCS->update($CS);
			
			$Title	= mb_strtoupper($CS->getName(), 'UTF8');
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("CỜ TƯỚNG", "/ung-dung/co-tuong"),
				array(mb_strtoupper($CB->getTitle(), 'UTF8'), $CB->getURLRead())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CS', 			$CS);
			$request->setObject('CB', 			$CB);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>