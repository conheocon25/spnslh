<?php		
	namespace MVC\Command;	
	class ImportSupplierOrder extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier 	= $request->getProperty('IdSupplier');
			$IdOrder 		= $request->getProperty('IdOrder');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mOrderImport 	= new \MVC\Mapper\OrderImport();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Supplier 	= $mSupplier->find($IdSupplier);
			$Order 		= $mOrderImport->find($IdOrder);
			$ConfigName	= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title = $Order->getDatePrint();
			$Navigation = array(
				array("NHẬP HÀNG", "/import"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Supplier->getURLImport())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
									
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Order'			, $Order);
			$request->setObject('Supplier'		, $Supplier);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>