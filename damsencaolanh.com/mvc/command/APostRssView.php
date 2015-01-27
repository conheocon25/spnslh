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
			$IdNewsRss = $request->getProperty('IdNewsRss');
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryBType 	= new \MVC\Mapper\CategoryBType();
			$mCategoryNews 		= new \MVC\Mapper\CategoryNews();						
			$mNewsRss 			= new \MVC\Mapper\NewsRss();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryBTypeAll 	= $mCategoryBType->findAll();
			$CategoryNewsAll 	= $mCategoryNews->findAll();			
			$NewsRss 				= $mNewsRss->find($IdNewsRss);
						
			$Title = $NewsRss->getTitle();
			$Navigation = array(
				array("DUYỆT TIN TỨC", "/app/news/rss")				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject( 'CategoryBTypeAll', $CategoryBTypeAll );
			$request->setObject( 'CategoryNewsAll', $CategoryNewsAll );									
			$request->setObject( 'NewsRss', $NewsRss );
			
			$request->setObject( 'Navigation', $Navigation );
			$request->setProperty("ActiveItem", 'NewsRss');
			$request->setProperty("Title", $Title);			
		}
	}
?>
