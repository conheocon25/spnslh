<?php		
	namespace MVC\Command;	
	class ABookChapter extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$IdBook 	= $request->getProperty('IdBook');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mBook 			= new \MVC\Mapper\Book();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Category		= $mCategoryBook->find($IdCategory);
			$Book 			= $mBook->find($IdBook);
												
			$Title 			= mb_strtoupper($Book->getTitle(), 'UTF8');
			$Navigation 	= array(
				array(mb_strtoupper("SÁCH CỜ / ".$Category->getName(), 'UTF8'), $Category->getURLSetting())
			);
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Book');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);			
			$request->setObject('Category'			, $Category);
			$request->setObject('Book'				, $Book);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>