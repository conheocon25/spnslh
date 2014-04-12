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
			$mDomain 	= new \MVC\Mapper\Domain();
			$mQuestion 	= new \MVC\Mapper\Question();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Domain 		= $mDomain->find($IdDomain);			
			$IndexQ			= $Session->getIndexQ();
			$ArrQ			= $Session->getArrQ();
												
			$Title 			= mb_strtoupper($Domain->getName(), 'UTF8');
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('ActiveItem', 'Start');
			$request->setProperty('Title', 		$Title);
			$request->setObject('Domain', 		$Domain);
			$request->setObject('Question', 	$ArrQ[$IndexQ]);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>