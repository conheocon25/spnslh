<?php
	namespace MVC\Command;	
	class SettingNewsInsLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryNews = new \MVC\Mapper\CategoryNews();

			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Category = $mCategoryNews->find($IdCategory);

			$Navigation = array(				
				array("Quản lý", "/setting"),
				array("Danh mục", "/setting/news/category"),
				array($Category->getName(), $Category->getURLSettingNews())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'Category', $Category );
			$request->setObject( 'Navigation', $Navigation );
			$request->setProperty("ActiveLeftMenu", 'SettingCategoryNews');
			$request->setProperty("Title", "Tạo mới");

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
