<?php		
	namespace MVC\Command;	
	class MoneyPaidCustomer extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCustomer = $request->getProperty('IdCustomer');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mPaid 		= new \MVC\Mapper\PaidCustomer();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CustomerAll = $mCustomer->findByNormal(array());
			if (!isset($IdCustomer)){
				$Customer = $CustomerAll->current();
				$IdCustomer = $Customer->getId();
			}else{
				$Customer = $mCustomer->find($IdCustomer);
			}
			$Config = $mConfig->findByName('ROW_PER_PAGE');
			if (!isset($Page)) $Page = 1;
			
			$PaidAll 	= $mPaid->findByPage(array($IdCustomer, $Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation( $Customer->getPaidAll()->count(), $Config->getValue(), $Customer->getURLPaid());
									
			$Title = mb_strtoupper($Customer->getName()." NỢ PHIẾU", 'UTF8');
			$Navigation = array(array("THU / CHI", "/money"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Customer', 	$Customer);
			$request->setObject('CustomerAll', 	$CustomerAll);
			$request->setObject('PaidAll', 		$PaidAll);
			$request->setObject('PN', 			$PN);
			$request->setProperty('Page', 		$Page);
			$request->setProperty('Title', 		$Title);			
			$request->setObject('Navigation', 	$Navigation);
		}
	}
?>