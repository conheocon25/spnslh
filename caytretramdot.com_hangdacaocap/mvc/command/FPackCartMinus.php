<?php
	namespace MVC\Command;	
	
	class FPackCartMinus extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdCart = $request->getProperty('IdCart');
			
			
			$DPackCart = $Session->getPackCart();
			
			if(isset($DPackCart)) {
				$DPackCart->minus($IdCart);
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