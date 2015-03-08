<?php
	namespace MVC\Command;	
	class FHome extends Command {
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
			$mVideo 		= new \MVC\Mapper\Video();									
			$mBook 			= new \MVC\Mapper\Book();
			$mPost 			= new \MVC\Mapper\Post();
			$mBoard 		= new \MVC\Mapper\Board();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mCategoryPost	= new \MVC\Mapper\CategoryPost();			
			$mCategoryBook	= new \MVC\Mapper\CategoryBook();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$ConfigPHome 		= $mConfig->findByName("PRESENTATION_HOME");
			$Presentation 		= $mPresentation->find($ConfigPHome->getValue());
			
			$VideoRandomAll 	= $mVideo->findByRandom(array());
			$VideoRecentAll 	= $mVideo->findByRecent(array());
			$VideoViewedAll 	= $mVideo->findByViewed(array());
			$VideoLikedAll 		= $mVideo->findByLiked(array());
			
			$PostTop 			= $mPost->findByTop(array())->current();
			
			$BookRandomAll 		= $mBook->findByRandom(array());
			$BookRecentAll 		= $mBook->findByRecent(array());
			$BookViewedAll 		= $mBook->findByViewed(array());
			$BookLikedAll 		= $mBook->findByLiked(array());
			
			$BoardRandomAll 	= $mBoard->findByRandom(array());
			$BoardRecentAll 	= $mBoard->findByRecent(array());
			$BoardViewedAll 	= $mBoard->findByViewed(array());
			$BoardLikedAll 		= $mBoard->findByLiked(array());
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setObject("PostTop", 				$PostTop);
			$request->setObject("Presentation", 		$Presentation);
			
			$request->setObject("VideoRandomAll", 		$VideoRandomAll);
			$request->setObject("VideoRecentAll", 		$VideoRecentAll);
			$request->setObject("VideoViewedAll", 		$VideoViewedAll);
			$request->setObject("VideoLikedAll", 		$VideoLikedAll);
									
			$request->setObject("BookRandomAll", 		$BookRandomAll);
			$request->setObject("BookRecentAll", 		$BookRecentAll);
			$request->setObject("BookViewedAll", 		$BookViewedAll);
			$request->setObject("BookLikedAll", 		$BookLikedAll);
			
			$request->setObject("BoardRandomAll", 		$BoardRandomAll);
			$request->setObject("BoardRecentAll", 		$BoardRecentAll);
			$request->setObject("BoardViewedAll", 		$BoardViewedAll);
			$request->setObject("BoardLikedAll", 		$BoardLikedAll);
			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>