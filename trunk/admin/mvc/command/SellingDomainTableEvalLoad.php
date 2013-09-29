<?php
	namespace MVC\Command;
	class SellingDomainTableEvalLoad extends Command{
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
			$Domain = $mDomain->find($IdDomain);
			$Table = $mTable->find($IdTable);
			$Session = $Table->getSessionActive();				
			$Title = mb_strtoupper("BÁN HÀNG / ".$Domain->getName()." / ".$Table->getName()." / TÍNH TIỀN", 'UTF8');
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Session', $Session);						
			$request->setObject('Table', $Table);						
			$request->setProperty('Title', $Title);
			$request->setProperty('URLHeader', $Table->getURLDetail() );
		}
	}
?>
