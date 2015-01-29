<?php
	namespace MVC\Command;		
	class FLogin extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			//$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();

			/*	
			Facebook\FacebookSession::setDefaultApplication('1550985445183957', 'f7345dd155eb805a0155a02cc430d351');

			$session = new Facebook\FacebookSession('access-token');
			
			$session = Facebook\FacebookSession::newAppSession();
			
			$session->validate();
			echo "Được làm gì đó ở đây";
			*/
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('CategoryPostAll', 	$CategoryPostAll);
			$request->setObject('CategoryBoardAll', $CategoryBoardAll);
			$request->setObject('CategoryBookAll', 	$CategoryBookAll);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>