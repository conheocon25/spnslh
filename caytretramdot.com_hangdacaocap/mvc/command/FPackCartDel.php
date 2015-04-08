<?php
	namespace MVC\Command;	
	
	class FPackCartDel extends Command {
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
			
			$mPackCart 	= new \MVC\Domain\PackCart();
			
			$DPackCart = $Session->getPackCart();
						
			if(isset($DPackCart)) {
				$DPackCart->deleteItem($IdCart);
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