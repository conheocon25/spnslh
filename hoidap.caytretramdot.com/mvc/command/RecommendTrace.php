<?php
	namespace MVC\Command;	
	class RecommendTrace extends Command {
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
			$Domain 	= $mDomain->find($IdDomain);
			$IndexQ			= $Session->getIndexQ();
			$ArrQ			= $Session->getArrQ();
			$ArrS			= $Session->getArrS();
			$ArrD			= $Session->getArrD();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('ActiveItem', 'Trace');
			$request->setProperty('IndexQ', 	$IndexQ);
			$request->setObject('Domain', 		$Domain);
			$request->setObject('ArrQ', 		$ArrQ);
			$request->setObject('ArrS', 		$ArrS);
			$request->setObject('ArrD', 		$ArrD);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>