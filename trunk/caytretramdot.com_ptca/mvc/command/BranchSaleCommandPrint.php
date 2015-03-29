<?php		
	namespace MVC\Command;	
	class BranchSaleCommandPrint extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdKey 		= $request->getProperty("IdKey");
			$IdCommand 	= $request->getProperty("IdCommand");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mBranch 	= new \MVC\Mapper\Branch();
			$mCommand 	= new \MVC\Mapper\SaleCommand();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Branch			= $mBranch->findByKey($IdKey);
			$Command		= $mCommand->find($IdCommand);
						
			$ConfigName		= $mConfig->findByName("NAME_COMPANY");
			$ConfigPhone	= $mConfig->findByName("PHONE1");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Branch'		, $Branch);
			$request->setObject('Command'		, $Command);
						
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>