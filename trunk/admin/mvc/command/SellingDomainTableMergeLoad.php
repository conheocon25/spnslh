<?php
	namespace MVC\Command;
	class SellingDomainTableMergeLoad extends Command{
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
			$TableAll = $mTable->findAll();
			$Table = $mTable->find($IdTable);
			$Domain = $mDomain->find($IdDomain);
									
			$Title = mb_strtoupper($Table->getName(), 'UTF8')." GOM ĐẾN";
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("BÁN HÀNG", "/selling"),
				array(mb_strtoupper($Domain->getName(), 'UTF8'), $Domain->getURLSelling())
			);
	
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('TableAll', $TableAll);
			$request->setObject('Table', $Table);
			$request->setObject('Navigation', $Navigation);
			$request->setProperty('Title', $Title);
		}
	}
?>
