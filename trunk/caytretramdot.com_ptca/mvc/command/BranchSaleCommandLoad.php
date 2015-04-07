<?php		
	namespace MVC\Command;	
	class BranchSaleCommandLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey = $request->getProperty('IdKey');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch				= $mBranch->findByKey($IdKey);
			$CommandAllQueue 	= $mSaleCommand->findByBranchQueue(array($Branch->getId()));
			$CommandAllFinish 	= $mSaleCommand->findByBranchFinish(array($Branch->getId()));
																	
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Branch"				, $Branch);
			$request->setObject("CommandAllQueue"		, $CommandAllQueue);
			$request->setObject("CommandAllFinish"		, $CommandAllFinish);
																					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>