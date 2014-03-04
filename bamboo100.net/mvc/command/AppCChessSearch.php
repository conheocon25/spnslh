<?php
	namespace MVC\Command;	
	class AppCChessSearch extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Term = $request->getProperty("Term");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mBook = new \MVC\Mapper\CBook();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$StrTerm = new \MVC\Library\String($Term);			
		
			$CBAll 		= $mBook->findLikeKey(array( $StrTerm->converturl() ));
			$Title		= "TÌM KIẾM";
			$Navigation = array(
				array("TRANG CHỦ", 		"/trang-chu"),
				array("HỌC CỜ TƯỚNG", 	"/hoc-co-tuong")
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 	'Trang chủ');
			$request->setProperty('Term', 	$Term);
			$request->setObject('CBAll', 	$CBAll);
			$request->setObject('Navigation', 	$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>