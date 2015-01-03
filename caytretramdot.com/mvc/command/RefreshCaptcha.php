<?php
	namespace MVC\Command;
	use MVC\Library\Captcha;	
	class RefreshCaptcha extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			//array_map('unlink', glob("/data/*.jpg"));
			
			$mCaptcha = new Captcha();
			$mCaptcha->createImage();
			$ImagePath = $mCaptcha->getImagePath();
			$Session->setCurrentCaptcha($mCaptcha->getSecurityCode());
								
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$Data = array('result' => $ImagePath );		
			echo json_encode($Data);
		}
	}
?>