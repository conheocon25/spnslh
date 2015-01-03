<?php
	namespace MVC\Command;	
	class SettingDomainTable extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty("Page");
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
				array("THIẾT LẬP", "/setting"),
				array("KHU VỰC", "/setting/domain")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
			
			$TableAll 	= $mTable->findByPage(array($IdDomain, $Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation($Domain->getTableAll()->count(), $Config->getValue(), $Domain->getURLTable());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Domain"	, $Domain);
			$request->setObject("DomainAll"	, $DomainAll);
			$request->setObject("TableAll"	, $TableAll);
			$request->setObject("ConfigName", $ConfigName);
						
			$request->setProperty("Title"	, $Title);
			$request->setProperty("Page"	, $Page);
			$request->setObject("Navigation", $Navigation);
			$request->setObject("PN"		, $PN);
		}
	}
?>