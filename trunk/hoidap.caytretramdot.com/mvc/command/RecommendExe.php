<?php
	namespace MVC\Command;	
	class RecommendExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty('IdDomain');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain = new \MVC\Mapper\Domain();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Domain 		= $mDomain->find($IdDomain);
			$QuestionAll 	= $Domain->getQuestionAll();
			$Question		= $QuestionAll->current();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('ActiveItem', 'Start');
			$request->setObject('Domain', 		$Domain);
			$request->setObject('Question', 	$Question);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>