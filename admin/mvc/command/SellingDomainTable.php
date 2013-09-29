<?php
	namespace MVC\Command;
	class SellingDomainTable extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mDomain = new \MVC\Mapper\Domain();
			$mTable = new \MVC\Mapper\Table();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Table = $mTable->find($IdTable);
			$Domain = $mDomain->find($IdDomain);
			
			
			$Title = mb_strtoupper("BÁN HÀNG / ".$Domain->getName()." / ".$Table->getName(), 'UTF8');
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("Table", $Table);
			$request->setObject("Domain", $Domain);
			$request->setProperty('Title', $Title);
			$request->setProperty('URLHeader', $Domain->getURLSelling());
		}
	}
?>
