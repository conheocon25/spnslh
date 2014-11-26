<?php
	namespace MVC\Command;
	class SellingTablePrint1 extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain 	= $request->getProperty("IdDomain");
			$IdTable 	= $request->getProperty("IdTable");
			$IdSession 	= $request->getProperty("IdSession");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mSession 	= new \MVC\Mapper\Session();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Table 		= $mTable->find($IdTable);
			$Domain 	= $mDomain->find($IdDomain);
			$Session 	= $mSession->find($IdSession);
			$Config 	= $mConfig->findByName("RECEIPT_VIRTUAL_DOUBLE");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("Table", 	$Table);
			$request->setObject("Domain", 	$Domain);
			$request->setObject("Session", 	$Session);
			$request->setObject("Config", 	$Config);
		}
	}
?>