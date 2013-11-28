<?php
	namespace MVC\Command;	
	class News extends Command {
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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$AllNews = $mNews->findAll();
			$AllCategoryNews = $mCategoryNews->findAll();
			$Navigation = array();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 'Tin tức');
			$request->setProperty('ActiveTopMenu', 'News');
			$request->setProperty('ActiveLeftMenu', 'News');
			$request->setObject('Navigation', $Navigation);
			$request->setObject('AllNews', $AllNews);
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>