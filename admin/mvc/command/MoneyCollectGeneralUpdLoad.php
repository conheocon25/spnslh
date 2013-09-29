<?php		
	namespace MVC\Command;	
	class MoneyCollectGeneralUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdTerm = $request->getProperty("IdTerm");
			$IdCollect = $request->getProperty("IdCollect");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mTerm = new \MVC\Mapper\TermCollect();
			$mCollect = new \MVC\Mapper\CollectGeneral();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Term = $mTerm->find($IdTerm);
			$Collect = $mCollect->find($IdCollect);
			
			$Title = $Collect->getDatePrint();						
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THU / CHI", "/money"),
				array("KHOẢN CHI", "/money/collect/general")
			);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('Title', $Title);			
			$request->setObject('Collect', $Collect);
			$request->setObject('Navigation', $Navigation);
		}
	}
?>