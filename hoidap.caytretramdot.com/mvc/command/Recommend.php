<?php
	namespace MVC\Command;	
	class Recommend extends Command {
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
			$DomainAll 	= $mDomain->findAll();
			if (!isset($IdDomain)){
				$Domain = $DomainAll->current();
				$IdDomain = $Domain->getId();
			}
			$Domain 	= $mDomain->find($IdDomain);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('DomainAll', 	$DomainAll);
			$request->setObject('Domain', 		$Domain);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>