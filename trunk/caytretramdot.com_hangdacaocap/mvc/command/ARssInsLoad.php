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
			$mTag = new \MVC\Mapper\Tag();
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			//$RssAll 	= $mRss->findAll();			
			$Title 		= mb_strtoupper("THÊM MỚI", 'UTF8');
			$AllTag 	= $mTag->findAll();
			$Navigation = array(
				array("RSS Lấy Tin", "/admin/setting/rss")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																					
			$request->setObject('Navigation', $Navigation);			
			$request->setProperty("ActiveAdmin", 'RssLink');
			$request->setProperty("AllTag", $AllTag);			
			$request->setProperty("Title", $Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>