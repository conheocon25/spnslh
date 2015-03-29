<?php		
	namespace MVC\Command;	
	class SaleCommandCheck extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------						
			$IdCommand 	= $request->getProperty("IdCommand");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Command	= $mCommand->find($IdCommand);
			$Command->setState(2);
			$mCommand->update($Command);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>