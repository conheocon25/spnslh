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
			$mQuestion = new \MVC\Mapper\Question();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Question = $mQuestion->find($IdQuestion);
			
			$Question->setContent($Content);
			$Question->setHint($Hint);
			$Question->setDateUpdated($DateUpdated);
			
			$mQuestion->update($Question);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
