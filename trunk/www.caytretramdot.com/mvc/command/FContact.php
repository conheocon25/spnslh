<?php
	namespace MVC\Command;	
	use MVC\Library\Captcha;
	class FContact extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();			
			$mTag 		= new \MVC\Mapper\Tag();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$TagAll 		= $mTag->findByPosition(array(1));									
			$mCaptcha = new Captcha();
			$mCaptcha->createImage();
			$Session->setCurrentCaptcha($mCaptcha->getSecurityCode());		
			
			$ImagePath = "/data/" . $mCaptcha->getImagePath();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("TagAll", 				$TagAll);
			$request->setProperty("ImagePath", $ImagePath);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>