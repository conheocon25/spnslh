<?php
	namespace MVC\Command;	
	class AppAdsSearch extends Command {
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
			$mPost = new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$StrTerm = new \MVC\Library\String($Term);			
			$PostAll = 	$mPost->findLikeKey(array($StrTerm->converturl()));
			$Navigation = array();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 'Trang chủ');
			$request->setProperty('Term', $Term);
			$request->setObject('PostAll', $PostAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>