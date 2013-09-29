<?php
	namespace MVC\Command;
	class SellingDomainTableSessionDetailDelLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTable = $request->getProperty("IdTable");
			$IdSessionDetail = $request->getProperty("IdSessionDetail");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTable = new \MVC\Mapper\Table();
			$mSD = new \MVC\Mapper\SessionDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Table = $mTable->find($IdTable);
			$SD = $mSD->find($IdSessionDetail);
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
			$request->setObject("Navigation", $Navigation);	
			$request->setProperty('Title', $Title);			
			$request->setProperty('URLHeader', $Table->getURLDetail() );			
		}
	}
?>