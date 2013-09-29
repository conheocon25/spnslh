<?php
	namespace MVC\Command;
	class SellingDomainTableSessionDetailUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSessionDetail = $request->getProperty("IdSessionDetail");
			$IdTable = $request->getProperty("IdTable");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSD = new \MVC\Mapper\SessionDetail();
			$mTable = new \MVC\Mapper\Table();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$SD = $mSD->find($IdSessionDetail);
			$Table = $mTable->find($IdTable);
			$Title = mb_strtoupper("...".$Table->getName()." / ".$SD->getCourse()->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("BÁN HÀNG", "/selling"),
				array(mb_strtoupper($Table->getDomain()->getName(), 'UTF8'), $Table->getDomain()->getURLSelling())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("SD", $SD);
			$request->setObject("Table", $Table);
			$request->setObject("Navigation", $Navigation);
			$request->setProperty('Title', $Title);
		}
	}
?>