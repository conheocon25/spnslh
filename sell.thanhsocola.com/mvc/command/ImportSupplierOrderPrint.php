<?php		
	namespace MVC\Command;	
	class ImportSupplierOrderPrint extends Command{
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
			$mOI 		= new \MVC\Mapper\OrderImport();
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mConfig 	= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$OI 			= $mOI->find($IdOrder);
			$Supplier 		= $mSupplier->find($IdSupplier);
			$DateCurrent 	= "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			$ConfigName		= $mConfig->findByName("NAME");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			$ConfigPhone	= $mConfig->findByName("PHONE");

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('DateCurrent'	, $DateCurrent);
			$request->setObject('OI'			, $OI);
			$request->setObject('Supplier'		, $Supplier );
			$request->setObject('ConfigName'	, $ConfigName );
			$request->setObject('ConfigAddress'	, $ConfigAddress );
			$request->setObject('ConfigPhone'	, $ConfigPhone );
		}
	}
?>