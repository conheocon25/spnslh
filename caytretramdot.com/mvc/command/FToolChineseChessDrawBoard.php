<?php
	namespace MVC\Command;	
	class FToolChineseChessDrawBoard extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$StrState 	= $request->getProperty('StrState');
			$Width 		= $request->getProperty('Width');
			$Height		= $request->getProperty('Height');
			//$StrState = "0 0 BE BA BK BA BE BH BR 0 0 0 0 0 0 0 0 0 0 BC 0 0 0 0 0 BC 0 BP 0 BP 0 BP 0 BP 0 BP 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 RP 0 RP 0 RP 0 RP 0 RP 0 RC 0 0 0 0 0 RC 0 0 0 0 0 0 0 0 0 0 RR RH RE RA RK RA RE RH RR";
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();						
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if ($Width<=0 || $Height<=0){
				$Width	= 480;
				$Height	= 640;
			}
			
			$Chess = new \MVC\Domain\Chess($Width, $Height, $StrState);
			$Chess->draw();
		}
	}
?>