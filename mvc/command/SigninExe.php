<?php
	namespace MVC\Command;	
	use MVC\Library\Encrypted;
	class SigninExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Email = $request->getProperty('Email');
			$Pass = $request->getProperty('Pass');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mUser = new \MVC\Mapper\User();
			$mApp = new \MVC\Mapper\App();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Email)||!isset($Pass)){
				$request->addFeedback("error");			
				return self::statuses('CMD_OK');
			}
			
			$IdUser = $mUser->check($Email, $Pass);
			if ($IdUser > 0){								
				$User = $mUser->find($IdUser);
				$App = $mApp->find(1);							
				$User->setApp($App);
				$Session->setCurrentUser($User);
			}else{				
				$request->addFeedback("error");
				return self::statuses('CMD_NO_AUTHOR');
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>