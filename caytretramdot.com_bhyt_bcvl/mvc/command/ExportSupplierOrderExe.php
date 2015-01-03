<?php		
	namespace MVC\Command;	
	class ExportSupplierOrderExe extends Command{
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
			$IdResource = $request->getProperty("IdResource");
			$Count = $request->getProperty("Count");
			$Price = $request->getProperty("Price");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
						
			$mSupplier = new \MVC\Mapper\Supplier();
			$mOE = new \MVC\Mapper\OrderExport();
			$mOED = new \MVC\Mapper\OrderExportDetail();
			$mResource = new \MVC\Mapper\Resource();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Supplier = $mSupplier->find($IdSupplier);
			$OI = $mOE->find($IdOrder);
			$Resource = $mResource->find($IdResource);
			
			//Kiểm tra xem record có tồn tại chưa
			$IdOID = $mOED->exist(array($IdOrder, $IdResource));
			
			if ($IdOID>0){
				if ($Count==0){
					$mOED->delete(array($IdOID));
				}else{
					$OID = $mOED->find($IdOID);
					$OID->setPrice($Price);
					$OID->setCount($Count);
					$mOED->update($OID);
				}
			}else{
				$OID = new \MVC\Domain\OrderExportDetail(
					null,
					$IdOrder,
					$IdResource,
					$Count,
					$Price
				);
				$mOED->insert($OID);
			}			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
		}
	}
?>