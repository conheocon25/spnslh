<?php
	namespace MVC\Command;	
	class APostRssView extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdPostRss = $request->getProperty('IdPostRss');
			
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
					
			$mPostRss 			= new \MVC\Mapper\PostRss();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			
			$PostRss 				= $mPostRss->find($IdPostRss);
						
			$Title = $PostRss->getTitle();
			$Navigation = array(
				array("DUYỆT TIN TỨC", "/admin/setting/post/rss")				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			
			$request->setObject( 'PostRss', $PostRss );
			
			$request->setObject( 'Navigation', $Navigation );
			$request->setProperty("ActiveAdmin", 'PostRss');
			$request->setProperty("Title", $Title);			
		}
	}
?>
