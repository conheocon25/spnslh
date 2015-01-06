<?php
	namespace MVC\Command;	
	class CheckingDomain extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdDomain = $request->getProperty("IdDomain");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$DomainAll 	= $mDomain->findAll();
			$Domain 	= $mDomain->find($IdDomain);
			
			$Title = mb_strtoupper($Domain->getName(), 'UTF8');
			$Navigation = array(				
				array("ĐÓNG PHÍ", "/checking")				
			);						
			$ConfigName = $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Domain"	, $Domain);
			$request->setObject("DomainAll"	, $DomainAll);			
			$request->setObject("ConfigName", $ConfigName);
						
			$request->setProperty("Title"	, $Title);			
			$request->setObject("Navigation", $Navigation);		
		}
	}
?>