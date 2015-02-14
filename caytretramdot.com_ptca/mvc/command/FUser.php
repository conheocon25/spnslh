<?php
	namespace MVC\Command;	
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	
	class FUser extends Command {
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
			$mPost 			= new \MVC\Mapper\Post();			
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			\Facebook\FacebookSession::setDefaultApplication('1550985445183957', 'f7345dd155eb805a0155a02cc430d351');
			
			$helper = new \Facebook\FacebookJavaScriptLoginHelper();
			try {
				$session = $helper->getSession();
				echo "1";
			} catch(FacebookRequestException $ex) {				
				echo "2";
			} catch(\Exception $ex) {				
				echo "3";
			}
			if ($session) {
				$request = new \Facebook\FacebookRequest($session, 'GET', '/me');
				$response = $request->execute();
				$graphObject = $response->getGraphObject();
				print_r($graphObject);
			}
						
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>