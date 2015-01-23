<?php		
	namespace MVC\Command;	
	class ABookInsLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mBook 			= new \MVC\Mapper\Book();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Category 	= $mCategoryBook->find($IdCategory);
			
			$Title = "THÊM SÁCH";
			$Navigation = array(				
				array("SÁCH CỜ / ".\mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLSetting())
			);
			
			$ConfigName	= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Book');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Category'		, $Category);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>