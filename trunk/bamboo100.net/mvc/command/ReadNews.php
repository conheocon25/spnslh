<?php
	namespace MVC\Command;	
	class ReadNews extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Key = $request->getProperty('Key');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$News = $mNews->findByKey($Key);
			$Category = $News->getCategory();
			$AllCategoryNews = $mCategoryNews->findAll();
			$Navigation = array(
				array("Tin tức", "/tin-tuc"),
				array($Category->getName(), $Category->getURLReadNews())
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $News->getTitleReduce());
			$request->setProperty('ActiveTopMenu', 'News');
			$request->setProperty('ActiveLeftMenu', $Category->getId());
			$request->setObject('Navigation', $Navigation);
			$request->setObject('AllCategoryNews', $AllCategoryNews);
			$request->setObject('News', $News);
			$request->setObject('Category', $Category);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>