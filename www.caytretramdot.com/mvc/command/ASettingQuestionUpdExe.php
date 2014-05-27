<?php
	namespace MVC\Command;	
	class ASettingQuestionUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdQuestion = $request->getProperty("IdQuestion");
			$Key 		= $request->getProperty("Key");
			
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Hint 		= \stripslashes($request->getProperty('Hint'));			
			$DateUpdated= date('Y-m-d h:i:s', \time());			
						
			$Detail1 	= \stripslashes($request->getProperty('Detail1'));
			$Detail2 	= \stripslashes($request->getProperty('Detail2'));
			$Detail3 	= \stripslashes($request->getProperty('Detail3'));
			$Detail4 	= \stripslashes($request->getProperty('Detail4'));
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mQuestion 	= new \MVC\Mapper\Question();
			$mQD 		= new \MVC\Mapper\QuestionDetail();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Question = $mQuestion->find($IdQuestion);
			
			$Question->setContent($Content);
			$Question->setHint($Hint);
			$Question->setDateUpdated($DateUpdated);
			$Question->setKey($Key);
			
			$mQuestion->update($Question);
			
			$QDAll 		= $Question->getDetailAll();
			$QD1 		= $QDAll->current();
			$QD1->setContent($Detail1);
			$mQD->update($QD1);
			
			$QDAll->next();
			$QD2 		= $QDAll->current();
			$QD2->setContent($Detail2);
			$mQD->update($QD2);
			
			$QDAll->next();
			$QD3 		= $QDAll->current();
			$QD3->setContent($Detail3);
			$mQD->update($QD3);
			
			$QDAll->next();
			$QD4 		= $QDAll->current();
			$QD4->setContent($Detail4);
			$mQD->update($QD4);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>