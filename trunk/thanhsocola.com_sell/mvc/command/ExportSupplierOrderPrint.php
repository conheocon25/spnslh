<?php		
	namespace MVC\Command;	
	class ExportSupplierOrderPrint extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$IdSupplier = $request->getProperty("IdSupplier");
			$IdOrder = $request->getProperty("IdOrder");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mOE 		= new \MVC\Mapper\OrderExport();
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mConfig 	= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$OE 			= $mOE->find($IdOrder);
			$Supplier 		= $mSupplier->find($IdSupplier);
			$DateCurrent 	= "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			$ConfigName		= $mConfig->findByName("NAME");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			$ConfigPhone	= $mConfig->findByName("PHONE");

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('DateCurrent'	, $DateCurrent);
			$request->setObject('OE'			, $OE);
			$request->setObject('Supplier'		, $Supplier );
			$request->setObject('ConfigName'	, $ConfigName );
			$request->setObject('ConfigAddress'	, $ConfigAddress );
			$request->setObject('ConfigPhone'	, $ConfigPhone );
		}
	}
?>