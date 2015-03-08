<?php		
	namespace MVC\Command;	
	class ABoardSubInsExe extends Command{
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
			$IdBoardDetail 	= $request->getProperty('IdBoardDetail');
			
			$Name 			= $request->getProperty('Name');
			$Round 			= $request->getProperty('Round');
			$Result 		= $request->getProperty('Result');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryBook	= new \MVC\Mapper\CategoryBook();
			$mBook 			= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mBoard 		= new \MVC\Mapper\Board();
			$mBoardSub 		= new \MVC\Mapper\BoardSub();
			$mBoardDetail	= new \MVC\Mapper\BoardDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$Category	= $mCategoryBook->find($IdCategory);
			$Book 		= $mBook->find($IdBook);
			$Chapter 	= $mChapter->find($IdChapter);
			$Board 		= $mBoard->find($IdBoard);
			$BoardDetail= $mBoardDetail->find($IdBoardDetail);
			
			if ($Round > 0)
				$State 	= $BoardDetail->getState1();
			else{				
				$BoardDetailAll = $mBoardDetail->findPre(array($BoardDetail->getIdBoard(), $BoardDetail->getMove()));
				$BoardDetailPre = $BoardDetailAll->current();
				$State 			= $BoardDetailPre->getState2();
			}
						
			$Board = new \MVC\Domain\Board(
				null, 
				$IdChapter, 
				$Name, 
				$State,
				date('Y-m-d H:i:s'),
				"rẽ nhánh",
				$BoardDetail->getMove(), 
				0, 
				0,
				$Round,
				$Result,
				1,
				1,
				1,
				""
			);
			
			$Board->reKey();
			
			$mBoard->insert($Board);
			$IdBoardNew = $Board->getId();
			
			$BoardSub = new \MVC\Domain\BoardSub(
				null,
				$IdBoard,
				$IdBoardNew,
				$IdBoardDetail
			);
			$mBoardSub->insert($BoardSub);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>