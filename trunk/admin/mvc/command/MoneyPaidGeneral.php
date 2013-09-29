<?php		
	namespace MVC\Command;	
	class MoneyPaidGeneral extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTerm = $request->getProperty('IdTerm');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTerm = new \MVC\Mapper\TermPaid();
			$mPaidGeneral = new \MVC\Mapper\PaidGeneral();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$TermAll = $mTerm->findAll();
			if (isset($IdTerm)){
				$Term = $mTerm->find($IdTerm);
			}else{
				$Term = $TermAll->current();
				$IdTerm = $Term->getId();
			}						
			$Config = $mConfig->findByName('ROW_PER_PAGE');
			if (!isset($Page)) $Page = 1;
			$PaidAll = $mPaidGeneral->findByPage(array($IdTerm, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Term->getPaids()->count(), $Config->getValue(), $Term->getURLDetail());
			
			$Title = "Khoản Chi";
			$Navigation = array(
				array("Thu / Chi", "/money")			
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Term', $Term);
			$request->setObject('TermAll', $TermAll);
			$request->setObject('PaidAll', $PaidAll);
			$request->setObject('PN', $PN);
			$request->setProperty('Page', $Page);
			$request->setProperty('Title', $Title);			
			$request->setObject('Navigation', $Navigation);
		}
	}
?>