<?php		
	namespace MVC\Command;	
	class AImportSupplierOrderExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$IdSupplier 	= $request->getProperty("IdSupplier");
			$IdOrder 		= $request->getProperty("IdOrder");
			$IdProduct 		= $request->getProperty("IdProduct");
			$Count 			= $request->getProperty("Count");
			$Price 			= $request->getProperty("Price");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
						
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mOI 		= new \MVC\Mapper\OrderImport();
			$mOID 		= new \MVC\Mapper\OrderImportDetail();
			$mProduct 	= new \MVC\Mapper\Product();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Supplier = $mSupplier->find($IdSupplier);
			$OI = $mOI->find($IdOrder);
			$Product = $mProduct->find($IdProduct);
			
			//Kiểm tra xem record có tồn tại chưa
			$IdOID = $mOID->exist(array($IdOrder, $IdProduct));
			
			if ($IdOID>0){
				if ($Count==0){
					$mOID->delete(array($IdOID));
				}else{
					$OID = $mOID->find($IdOID);
					$OID->setPrice($Price);
					$OID->setCount($Count);
					$mOID->update($OID);
				}
			}else{
				$OID = new \MVC\Domain\OrderImportDetail(
					null,
					$IdOrder,
					$IdProduct,
					$Count,
					$Price
				);
				$mOID->insert($OID);
			}			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
		}
	}
?>