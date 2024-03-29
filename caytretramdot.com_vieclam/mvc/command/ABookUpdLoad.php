<?php		
	namespace MVC\Command;	
	class ABookUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory 	= $request->getProperty('IdCategory');
			$IdBook 		= $request->getProperty('IdBook');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBook 		= new \MVC\Mapper\Book();
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$Book 		= $mBook->find($IdBook);
			$Category 	= $Book->getCategory();
			
			$Title 		= \mb_strtoupper($Book->getTitle(), 'UTF8');
			$Navigation = array(								
				array("SÁCH / ".\mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLSetting()),				
			);
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('Book'			, $Book);
			$request->setObject('Category'		, $Category);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>