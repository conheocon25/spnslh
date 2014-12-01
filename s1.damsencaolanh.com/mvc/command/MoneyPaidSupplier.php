<?php		
	namespace MVC\Command;	
	class MoneyPaidSupplier extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier = $request->getProperty('IdSupplier');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mPaidSupplier 	= new \MVC\Mapper\PaidSupplier();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$SupplierAll = $mSupplier->findAll();
			if (isset($IdSupplier)){
				$Supplier 	= $mSupplier->find($IdSupplier);
			}else{
				$Supplier 	= $SupplierAll->current();
				$IdSupplier = $Supplier->getId();
			}
			$Config 	= $mConfig->findByName('ROW_PER_PAGE');
			$ConfigName = $mConfig->findByName('NAME');
			
			if (!isset($Page)) $Page = 1;
			$PaidAll = $mPaidSupplier->findByPage(array($IdSupplier, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Supplier->getPaidAll()->count(), $Config->getValue(), $Supplier->getURLPaid());
			
			$Title = $Supplier->getName()." > CHI";
			$Navigation = array(
				array("THU / CHI", "/money")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Supplier'		, $Supplier);
			$request->setObject('SupplierAll'	, $SupplierAll);
			$request->setObject('PaidAll'		, $PaidAll);
			$request->setObject('PN'			, $PN);
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setProperty('Page'		, $Page);
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
		}
	}
?>