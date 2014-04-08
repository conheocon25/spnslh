<?php		
	namespace MVC\Command;	
	class SettingDomainSolve extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mConfig = new \MVC\Mapper\Config();
			$mDomain = new \MVC\Mapper\Domain();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$DomainAll 	= $mDomain->findAll();
			$Domain 	= $mDomain->find($IdDomain);
			
			$Title = mb_strtoupper($Domain->getName(), 'UTF8');
			
			$Navigation = array(
					array("THIẾT LẬP", 	"/setting"),
					array("LĨNH VỰC", 	"/setting/domain")
			);			
			$ConfigName = $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Domain'		, $Domain);
			$request->setObject('DomainAll'		, $DomainAll);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>