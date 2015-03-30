<?php		
	namespace MVC\Command;	
	class SettingCustomer extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 		= $request->getProperty('Page');
			$IdBranch 	= $request->getProperty('IdBranch');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mPaymentMethod		= new \MVC\Mapper\PaymentMethod();
			$mBranch 			= new \MVC\Mapper\Branch();
			$mCustomer 			= new \MVC\Mapper\Customer();
			$mCustomerGroup 	= new \MVC\Mapper\CustomerGroup();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$BranchAll			= $mBranch->findAll();
			if (!isset($IdBranch)){
				$Branch = $BranchAll->current();
				$IdBranch = $Branch->getId();
			}else{
				$Branch	= $mBranch->find($IdBranch);
			}
									
			$PaymentMethodAll	= $mPaymentMethod->findAll();			
			$GroupAll			= $mCustomerGroup->findAll();
			$CustomerAll 		= $mCustomer->findByBranch(array($IdBranch));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");			
			$CustomerAll1 	= $mCustomer->findByBranchPage(array($IdBranch, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CustomerAll->count(), $Config->getValue(), $Branch->getURLSettingCustomer() );
			
			$Title = mb_strtoupper($Branch->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 			"/ql-thiet-lap"),
				array("KHÁCH HÀNG", 	"/ql-thiet-lap/khach-hang")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setProperty('Title'			, $Title);			
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);			
			$request->setObject('PaymentMethodAll'	, $PaymentMethodAll);
			$request->setObject('Branch'			, $Branch);
			$request->setObject('GroupAll'			, $GroupAll);
			$request->setObject('BranchAll'			, $BranchAll);
			$request->setObject('CustomerAll1'		, $CustomerAll1);
																					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>