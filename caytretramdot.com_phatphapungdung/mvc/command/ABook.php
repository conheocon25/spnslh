<?php		
	namespace MVC\Command;	
	class ABook extends Command {
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
			$CategoryBookAll	= $mCategoryBook->findAll();
			if (!isset($IdCategory)){
				$IdCategory = $CategoryBookAll->current()->getId();
			}
			
			$Category		= $mCategoryBook->find($IdCategory);
			$BookAll 		= $mBook->findBy(array($IdCategory));
									
			$Title 			= "SÁCH / ". mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation 	= array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Book');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryBookAll'	, $CategoryBookAll);			
			$request->setObject('Category'			, $Category);
			$request->setObject('BookAll'			, $BookAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>