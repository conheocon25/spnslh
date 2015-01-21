<?php		
	namespace MVC\Command;	
	class ABookChapterUpdLoad extends Command{
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
			$IdChapter 		= $request->getProperty('IdChapter');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mBook 			= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$Chapter 	= $mChapter->find($IdChapter);
			$Book 		= $mBook->find($IdBook);
			$Category 	= $Book->getCategory();
			
			$Title 		= \mb_strtoupper($Chapter->getTitle(), 'UTF8');
			$Navigation = array(								
				array(\mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLSetting()),
				array(\mb_strtoupper($Book->getTitle(), 'UTF8'), $Book->getURLSettingChapter()),
			);
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('Book'			, $Book);
			$request->setObject('Category'		, $Category);
			$request->setObject('Chapter'		, $Chapter);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>