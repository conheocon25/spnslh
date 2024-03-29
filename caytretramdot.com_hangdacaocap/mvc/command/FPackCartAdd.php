<?php
	namespace MVC\Command;	
	
	class FPackCartAdd extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			
			$IdProduct = $request->getProperty('IdProduct');
			
			$mProduct 	= new \MVC\Mapper\Product();
			$mPackCart 	= new \MVC\Domain\PackCart();
			
			$DPackCart = $Session->getPackCart();
			
			if(isset($IdProduct)) {
				$dProduct = $mProduct->find($IdProduct);
			}
			if(!isset($DPackCart)) {
				$mPackCart->addItem($dProduct->getName(),$IdProduct, $dProduct->getPrice1(), $dProduct->getInfo()->getImage1(), 1);
				$Session->setPackCart($mPackCart);
			} else
			{				
				$DPackCart->addItem($dProduct->getName(), $IdProduct, $dProduct->getPrice1(), $dProduct->getInfo()->getImage1(), 1);
				$Session->setPackCart($DPackCart);
			}
			
			return self::statuses('CMD_OK');
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>