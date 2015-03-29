<?php		
	namespace MVC\Command;	
	class SaleCommandView extends Command{
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
			$mGood 		= new \MVC\Mapper\Good();			
			$mCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Command	= $mCommand->find($IdCommand);
			$GoodAll	= $mGood->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Command'		, $Command);
			$request->setObject('GoodAll'		, $GoodAll);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>