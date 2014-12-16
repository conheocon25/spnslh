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
			$Info 		= \stripslashes($request->getProperty('Info'));
			$InfoEx01 	= $request->getProperty('InfoEx01');
			$InfoEx02 	= $request->getProperty('InfoEx02');
			$InfoEx03 	= $request->getProperty('InfoEx03');
			$InfoEx04 	= $request->getProperty('InfoEx04');
			$InfoEx05 	= $request->getProperty('InfoEx05')=="on"?1:0;
			$InfoEx06 	= $request->getProperty('InfoEx06');
			$InfoEx07 	= $request->getProperty('InfoEx07');
			$InfoEx08 	= $request->getProperty('InfoEx08')=="on"?1:0;
			$InfoEx09 	= $request->getProperty('InfoEx09')=="on"?1:0;
			$InfoEx10 	= $request->getProperty('InfoEx10')=="on"?1:0;
			$InfoEx11 	= $request->getProperty('InfoEx11')=="on"?1:0;
			$InfoEx12 	= $request->getProperty('InfoEx12')=="on"?1:0;
			$InfoEx13 	= $request->getProperty('InfoEx13');
			
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
					"Thu nghiem",
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				$mProductInfo->insert($PI);
			}else{
				$PI = $mProductInfo->find($IdPI);
			}
			$PI->setInfo($Info);
			$PI->setInfoEx01($InfoEx01);
			$PI->setInfoEx02($InfoEx02);
			$PI->setInfoEx03($InfoEx03);
			$PI->setInfoEx04($InfoEx04);
			$PI->setInfoEx05($InfoEx05);
			$PI->setInfoEx06($InfoEx06);
			$PI->setInfoEx07($InfoEx07);
			$PI->setInfoEx08($InfoEx08);
			$PI->setInfoEx09($InfoEx09);
			$PI->setInfoEx10($InfoEx10);
			$PI->setInfoEx11($InfoEx11);
			$PI->setInfoEx12($InfoEx12);
			$PI->setInfoEx13($InfoEx13);
			
			$mProductInfo->update($PI);
			
			return self::statuses('CMD_OK');
		}
	}
?>