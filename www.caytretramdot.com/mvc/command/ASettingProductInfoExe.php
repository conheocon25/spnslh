<?php		
	namespace MVC\Command;	
	class ASettingProductInfoExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdSupplier = $request->getProperty('IdSupplier');
			$IdProduct 	= $request->getProperty('IdProduct');
			$Image1 	= $request->getProperty('Image1');
			$Image2 	= $request->getProperty('Image2');
			$Info 		= $request->getProperty('Info');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mProductInfo	= new \MVC\Mapper\ProductInfo();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$IdPI  			= $mProductInfo->exist(array($IdProduct));
			if ($IdPI==-1){
				$PI = new \MVC\Domain\ProductInfo(
					null,
					$IdProduct,
					$Image1,
					$Image2,
					"Thu nghiem"
				);
				$mProductInfo->insert($PI);
			}else{
				$PI = $mProductInfo->find($IdPI);
			}
			$PI->setInfo($Info);
			$PI->setImage1($Image1);
			$PI->setImage2($Image2);
			$mProductInfo->update($PI);
			
			return self::statuses('CMD_OK');
		}
	}
?>