<?php
	namespace MVC\Command;	
	class ASettingQuestionInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Hint 		= $request->getProperty('Hint');
			$DateCreated= date('Y-m-d h:i:s', \time());
			$DateUpdated= date('Y-m-d h:i:s', \time());
			$Type 		= 1;
			$Owner		= $Session->getCurrentIdUser();
			$Key 		= $request->getProperty('Key');
			
			$Detail1 	= \stripslashes($request->getProperty('Detail1'));
			$Detail2 	= \stripslashes($request->getProperty('Detail2'));
			$Detail3 	= \stripslashes($request->getProperty('Detail3'));
			$Detail4 	= \stripslashes($request->getProperty('Detail4'));
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mQuestion = new \MVC\Mapper\Question();
			$mQuestionDetail = new \MVC\Mapper\QuestionDetail();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Question = new \MVC\Domain\Question(
				null,				
				$Content,
				$Type,
				$DateCreated,
				$DateUpdated,
				1,
				$Hint,
				$Key
			);									
			$mQuestion->insert($Question);
			
			$IdQuestion = $Question->getId();
			$QD1 = new \MVC\Domain\QuestionDetail(
				null,
				$IdQuestion,
				$Detail1,
				1
			);
			$mQuestionDetail->insert($QD1);
			
			$QD2 = new \MVC\Domain\QuestionDetail(
				null,
				$IdQuestion,
				$Detail2,
				2
			);
			$mQuestionDetail->insert($QD2);
			
			$QD3 = new \MVC\Domain\QuestionDetail(
				null,
				$IdQuestion,
				$Detail3,
				3
			);
			$mQuestionDetail->insert($QD3);
			
			$QD4 = new \MVC\Domain\QuestionDetail(
				null,
				$IdQuestion,
				$Detail4,
				4
			);
			$mQuestionDetail->insert($QD4);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
