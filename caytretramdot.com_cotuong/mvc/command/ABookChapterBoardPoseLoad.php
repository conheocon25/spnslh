<?php		
	namespace MVC\Command;	
	class ABookChapterBoardPoseLoad extends Command {
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
			$IdChapter 	= $request->getProperty('IdChapter');
			$IdBoard 	= $request->getProperty('IdBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mBook 			= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mBoard 		= new \MVC\Mapper\Board();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Category	= $mCategoryBoard->find($IdCategory);
			$Book		= $mBook->find($IdBook);
			$Chapter	= $mChapter->find($IdChapter);
			$Board		= $mBoard->find($IdBoard);
									
			$Title 		= mb_strtoupper($Chapter->getTitle(), 'UTF8')." / VÁN CỜ";
			$Navigation = array(
				array(mb_strtoupper("SÁCH CỜ / ".$Category->getName(), 'UTF8')	, $Category->getURLSetting()),
				array(mb_strtoupper($Book->getTitle(), 'UTF8')					, $Book->getURLSettingChapter())
			);
			$ConfigName = $mConfig->findByName("NAME");
			
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