<?php		
	namespace MVC\Command;	
	class ASettingQuestionUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdQuestion = $request->getProperty('IdQuestion');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig	= new \MVC\Mapper\Config();
			$mQuestion 	= new \MVC\Mapper\Question();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$Question 	= $mQuestion->find($IdQuestion);
			
			$Title = "CẬP NHẬT";
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("CÂU HỎI", 	"/admin/setting/question")				
			);									
			$ConfigName	= $mConfig->findByName("NAME");
			
			$QDAll 		= $Question->getDetailAll();
			$QD1 		= $QDAll->current();
			
			$QDAll->next();
			$QD2 		= $QDAll->current();
			
			$QDAll->next();
			$QD3 		= $QDAll->current();
			
			$QDAll->next();
			$QD4 		= $QDAll->current();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Question'		, $Question);
			$request->setObject('QD1'			, $QD1);
			$request->setObject('QD2'			, $QD2);
			$request->setObject('QD3'			, $QD3);
			$request->setObject('QD4'			, $QD4);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>