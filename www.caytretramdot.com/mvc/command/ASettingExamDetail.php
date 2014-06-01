<?php		
	namespace MVC\Command;	
	class ASettingExamDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdExam 	= $request->getProperty('IdExam');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 	= new \MVC\Mapper\Config();
			$mExam 		= new \MVC\Mapper\Exam();
			$mQuestion 	= new \MVC\Mapper\Question();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
						
			$Title = "CHI TIẾT";
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("ĐỀ THI", 	"/admin/setting/exam")				
			);
			
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$Exam 			= $mExam->find($IdExam);
			$QuestionAll 	= $mQuestion->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Exam');					
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);						
			$request->setObject('Exam'			, $Exam);
			$request->setObject('QuestionAll'	, $QuestionAll);	
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>