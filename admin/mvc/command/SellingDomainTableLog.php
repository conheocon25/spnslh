<?php
	namespace MVC\Command;
	class SellingDomainTableLog extends Command {
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
			$IdTable = $request->getProperty("IdTable");
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain = new \MVC\Mapper\Domain();
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Domain = $mDomain->find($IdDomain);
			$Table = $mTable->find($IdTable);
			if (!isset($Page)) $Page = 1;
			$Config = $mConfig->findByName('ROW_PER_PAGE');
						
			$SessionAll = $mSession->findByTablePage(array($IdTable, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Table->getSessions()->count(), $Config->getValue(), $Table->getURLLog());
			
			$Title = mb_strtoupper($Table->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("BÁN HÀNG", "/selling"),
				array(mb_strtoupper($Domain->getName(), 'UTF8'), $Domain->getURLSelling())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty("Title", $Title);
			$request->setProperty("URLHeader", $Domain->getURLSelling());
			$request->setObject("Domain", $Domain);
			$request->setObject("Table", $Table);
			$request->setObject("SessionAll", $SessionAll);
			
			$request->setObject("Navigation", $Navigation);
			$request->setObject("PN", $PN);
			$request->setProperty("Page", $Page);
		}
	}
?>
