<?php
	namespace MVC\Command;	
	class APostRss extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			//$Page = $request->getProperty('Page');
			//$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			//$mPostTag 		= new \MVC\Mapper\PostTag();
			$mPostRss 		= new \MVC\Mapper\PostRss();
			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------	
			
			$PostRssAll = $mPostRss->findAll();	
			//$PostTagAll = $mPostTag->findAll();						
			
			$Title = mb_strtoupper("DUYỆT TIN TỨC TỪ RSS URL", 'UTF8');
			$Navigation = array(				
				array("DUYỆT TIN TỨC", "/admin/setting/post/rss")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("PostRssAll", $PostRssAll);
			//$request->setObject("PostTagAll", $PostTagAll);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveAdmin", 'PostRss');
			return self::statuses('CMD_DEFAULT');
		}
	}
?>