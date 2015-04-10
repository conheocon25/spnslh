<?php
	namespace MVC\Command;	
	class ARssInsLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
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
			$mRss = new \MVC\Mapper\RssLink();
			$mCategoryPost = new \MVC\Mapper\CategoryPost();
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			//$RssAll 	= $mRss->findAll();			
			$Title 		= mb_strtoupper("THÊM MỚI", 'UTF8');
			$CategoryPosts 	= $mCategoryPost->findAll();
			$Navigation = array(
				array("RSS Lấy Tin", "/admin/setting/rss")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																					
			$request->setObject('Navigation', $Navigation);			
			$request->setProperty("ActiveAdmin", 'RssLink');
			$request->setProperty("CategoryPosts", $CategoryPosts);			
			$request->setProperty("Title", $Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>