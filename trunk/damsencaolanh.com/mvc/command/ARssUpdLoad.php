<?php
	namespace MVC\Command;	
	class ARssUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdRss = $request->getProperty('IdRss');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mRss = new \MVC\Mapper\RssLink();
			$mCategoryNews = new \MVC\Mapper\CategoryNews();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Rss 		= $mRss->find($IdRss);
			$AllCategoryNews 		= $mCategoryNews->findAll();
			$Title 		= mb_strtoupper("CẬP NHẬT RSS Link", 'UTF8');
			
			$Navigation = array(array("RSS Lấy Tin", "/app/rss"));
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																					
			$request->setObject('Navigation', 	$Navigation);
			$request->setObject('Rss', 		$Rss);			
			$request->setObject('AllCategoryNews', 		$AllCategoryNews);			
			$request->setProperty("Title", 		$Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>