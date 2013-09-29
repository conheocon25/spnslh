<?php		
	namespace MVC\Command;	
	class MoneyPaidGeneralUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdPaid = $request->getProperty("IdPaid");
			$IdTerm = $request->getProperty("IdTerm");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mTerm = new \MVC\Mapper\TermPaid();
			$mPaid = new \MVC\Mapper\PaidGeneral();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Term = $mTerm->find($IdTerm);
			$Paid = $mPaid->find($IdPaid);
			
			$Title = $Paid->getDatePrint();
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THU / CHI", "/money"),
				array("KHOẢN CHI", "/money/paid/general")
			);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('Title', $Title);			
			$request->setObject('Paid', $Paid);
			$request->setObject('Navigation', $Navigation);
			
		}
	}
?>