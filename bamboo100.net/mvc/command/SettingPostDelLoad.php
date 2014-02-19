<?php
	namespace MVC\Command;	
	class SettingPostDelLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdPost = $request->getProperty('IdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost = new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Post = $mPost->find($IdPost);
			
			$Navigation = array(				
				array("QUẢN LÝ", "/quan-ly"),
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
			$request->setProperty("Title", "Xóa: ".$News->getTitleReduce());

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
