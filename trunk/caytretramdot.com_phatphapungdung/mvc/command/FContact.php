<?php
	namespace MVC\Command;	
	use MVC\Library\Captcha;
	class FContact extends Command {
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
			$mConfig 		= new \MVC\Mapper\Config();						
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryPostAll 	= $mCategoryPost->findAll();			
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('CategoryPostAll', 	$CategoryPostAll);						
			$request->setObject("CategoryBuddhaAll", $CategoryBuddhaAll);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>