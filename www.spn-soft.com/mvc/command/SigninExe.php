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
			$mUserApp = new \MVC\Mapper\UserApp();
									
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
				try {
					$client = new \SoapClient('http://apis.123app.net/limit/limit.wsdl', array('trace'=>true));
					$D = $client->increase(date("Y-m-d H:i:s"));
					$App->setDateActivity($D);
					$mApp->update($App);
					
				} catch (\Exception $e) {
					if ($App->remainPercentUpdated()<=0){
						$request->addFeedback("error_update");
						return self::statuses('CMD_NO_AUTHOR');
					}
				}				
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