<?php
	namespace MVC\Command;	
	class SettingNewsUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdNews = $request->getProperty('Id');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryNews = new \MVC\Mapper\CategoryNews();
			$mNews = new \MVC\Mapper\News();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$News = $mNews->find($IdNews);
			$Category = $mCategoryNews->find($News->getIdCategory());

			$Navigation = array(				
				array("Quản lý", "/setting"),
				array("Danh mục", "/setting/news/category"),
				array($Category->getName(), $Category->getURLSettingNews())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'News', $News );
			$request->setObject( 'Category', $Category );
			$request->setObject( 'Navigation', $Navigation );
			$request->setProperty("ActiveLeftMenu", 'SettingCategoryNews');
			$request->setProperty("Title", "Cập nhật: ".$News->getTitleReduce());

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
