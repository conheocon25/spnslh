<?php		
	namespace MVC\Command;	
	class BranchSaleInvoiceCustomerSearch extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey 		= $request->getProperty('IdKey');
			$NameSearch = $request->getProperty('NameSearch');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mCustomer 		= new \MVC\Mapper\Customer();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch			= $mBranch->findByKey($IdKey);
			$CustomerAll 	= $mCustomer->findByBranchName(array($Branch->getId(), $NameSearch."%"));
								
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("CustomerAll", $CustomerAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>