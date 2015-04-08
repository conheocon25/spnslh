<?php
	namespace MVC\Command;	
	
	class FPackCartDelAll extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			
			$mPackCart 	= new \MVC\Domain\PackCart();
			
			$DPackCart = $Session->getPackCart();
						
			if(isset($DPackCart)) {				
				$Session->setPackCart($mPackCart);
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