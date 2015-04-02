<?php		
	namespace MVC\Command;	
	class SettingCustomerInit extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdBranch 	= $request->getProperty('IdBranch');
			$IdCustomer = $request->getProperty('IdCustomer');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBranch 			= new \MVC\Mapper\Branch();
			$mCustomer 			= new \MVC\Mapper\Customer();
			$mCustomerInit 		= new \MVC\Mapper\CustomerInit();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch				= $mBranch->find($IdBranch);
			$CustomerInit		= $mCustomerInit->check($IdCustomer);
			$Customer			= $mCustomer->find($IdCustomer);
			
			if (!isset($CustomerInit)){
				$CustomerInit = new \MVC\Domain\CustomerInit(null, $IdCustomer, 1);
				$mCustomerInit->insert($CustomerInit);
			}			
						
			$Title = mb_strtoupper($Customer->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 									"/ql-thiet-lap"),
				array("KHÁCH HÀNG", 								"/ql-thiet-lap/khach-hang"),
				array(mb_strtoupper($Branch->getName(), 'UTF8'), 	$Branch->getURLSettingCustomer())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('Title'			, $Title);			
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('Branch'			, $Branch);
			$request->setObject('Customer'			, $Customer);
			$request->setObject('CustomerInit'		, $CustomerInit);
																								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>