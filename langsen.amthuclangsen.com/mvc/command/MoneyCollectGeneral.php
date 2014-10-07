<?php		
	namespace MVC\Command;	
	class MoneyCollectGeneral extends Command {
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
			$mTerm 				= new \MVC\Mapper\TermCollect();
			$mCollectGeneral 	= new \MVC\Mapper\CollectGeneral();
			$mConfig 			= new \MVC\Mapper\Config();
			
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
			$Config 	= $mConfig->findByName('ROW_PER_PAGE');
			$ConfigName = $mConfig->findByName('NAME');
			
			if (!isset($Page)) $Page = 1;
			$CollectAll = $mCollectGeneral->findByPage(array($IdTerm, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Term->getCollectAll()->count(), $Config->getValue(), $Term->getURLCollect());
			
			$Title = "KHOẢN THU KHÁC";
			$Navigation = array(
				array("THU / CHI", "/money"),				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Term'		, $Term);
			$request->setObject('TermAll'	, $TermAll);
			$request->setObject('CollectAll', $CollectAll);
			$request->setObject('PN'		, $PN);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setProperty('Page'	, $Page);
			$request->setProperty('Title'	, $Title);			
			$request->setObject('Navigation', $Navigation);
		}
	}
?>