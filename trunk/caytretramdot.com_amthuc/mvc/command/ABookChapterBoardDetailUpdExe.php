<?php		
	namespace MVC\Command;	
	class ABookChapterBoardDetailUpdExe extends Command{
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
			$Note1 			= \stripslashes($request->getProperty('Note1'));
			$Note2 			= \stripslashes($request->getProperty('Note2'));
			$Pre1 			= $request->getProperty('Pre1');
			$Pre2 			= $request->getProperty('Pre2');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mBoardDetail 	= new \MVC\Mapper\BoardDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																				
			$BoardDetail= $mBoardDetail->find($IdBoardDetail);
			$BoardDetail->setNote1($Note1);
			$BoardDetail->setNote2($Note2);
			$BoardDetail->setPre1($Pre1);
			$BoardDetail->setPre2($Pre2);
			$mBoardDetail->update($BoardDetail);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			return self::statuses('CMD_OK');
		}
	}
?>