<?php		
	namespace MVC\Command;	
	class SalePriceBranchCustomer extends Command {
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
			$mConfig 	= new \MVC\Mapper\Config();
			$mBranch 	= new \MVC\Mapper\Branch();
			$mCustomer 	= new \MVC\Mapper\Customer();
																		
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch 	= $mBranch->find($IdBranch);
			$Customer 	= $mCustomer->find($IdCustomer);
			
			$Title 		= mb_strtoupper($Customer->getName(), 'UTF8');
			$Navigation = array(
				array("BÁN HÀNG"		, "/ql-ban-hang"),
				array("GIÁ BÁN"			, "/ql-ban-hang/gia-ban"),
				array($Branch->getName(), $Branch->getURLPrice())
			);			
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title"	, 	$Title);
			$request->setObject("Navigation", 	$Navigation);
			$request->setObject("Branch", 		$Branch);
			$request->setObject("Customer", 	$Customer);
																	
			return self::statuses('CMD_DEFAULT');
		}
	}
?>