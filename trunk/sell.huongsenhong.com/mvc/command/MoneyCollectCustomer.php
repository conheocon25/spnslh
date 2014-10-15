<?php		
	namespace MVC\Command;	
	class MoneyCollectCustomer extends Command {
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
			$mCustomer = new \MVC\Mapper\Customer();
			$mCollect = new \MVC\Mapper\CollectCustomer();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CustomerAll = $mCustomer->findAll();
			if (!isset($IdCustomer)){
				$Customer = $CustomerAll->current();
				$IdCustomer = $Customer->getId();
			}else{
				$Customer = $mCustomer->find($IdCustomer);
			}
			$Config = $mConfig->findByName('ROW_PER_PAGE');
			if (!isset($Page)) $Page = 1;
			$CollectAll = $mCollect->findByPage(array($IdCustomer, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Customer->getCollectAll()->count(), $Config->getValue(), $Customer->getURLCollect());
			
			$Title = mb_strtoupper($Customer->getName(), 'UTF8');
			$Navigation = array(			
				array("KHOẢN THU", "/collect"),
				array("CHUNG", "/collect/general")
			);
			
			$Title = "KHOẢN THU KHÁC";
			$Navigation = array(
				array("THU / CHI", "/money"),				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Customer', $Customer);
			$request->setObject('CustomerAll', $CustomerAll);
			$request->setObject('CollectAll', $CollectAll);
			$request->setObject('PN', $PN);
			$request->setProperty('Page', $Page);
			$request->setProperty('Title', $Title);			
			$request->setObject('Navigation', $Navigation);
		}
	}
?>