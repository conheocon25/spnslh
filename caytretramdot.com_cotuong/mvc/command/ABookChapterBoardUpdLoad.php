<?php		
	namespace MVC\Command;	
	class ABookChapterBoardUpdLoad extends Command{
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
			$IdBoard 		= $request->getProperty('IdBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryBook	= new \MVC\Mapper\CategoryBook();
			$mBook 			= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mBoard 		= new \MVC\Mapper\Board();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$Category	= $mCategoryBook->find($IdCategory);
			$Book 		= $mBook->find($IdBook);
			$Chapter 	= $mChapter->find($IdChapter);
			$Board 		= $mBoard->find($IdBoard);
						
			$Title 		= mb_strtoupper($Board->getName(), 'UTF8');
			$Navigation = array(				
				array(mb_strtoupper("SÁCH CỜ / ".$Category->getName(), 'UTF8')	, $Category->getURLSetting()),
				array(mb_strtoupper($Book->getTitleReduce(), 'UTF8')					, $Book->getURLSettingChapter()),
				array(mb_strtoupper($Chapter->getTitleReduce(), 'UTF8')				, $Chapter->getURLSettingBoard())
			);
			
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			
			$request->setObject('Category'		, $Category);
			$request->setObject('Book'			, $Book);
			$request->setObject('Chapter'		, $Chapter);
			$request->setObject('Board'			, $Board);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>