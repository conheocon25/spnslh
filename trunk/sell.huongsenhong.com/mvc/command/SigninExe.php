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
			$mUser 		= new \MVC\Mapper\User();			
			$mTracking 	= new \MVC\Mapper\Tracking();
			
			$IdUser = 0;
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			if (isset($Email) && isset($Pass)){				
				$IdUser = $mUser->check($Email, $Pass);				
				if ($IdUser > 0){								
					$User = $mUser->find($IdUser);					
					$Session->setCurrentIdUser($IdUser);
					$Session->setCurrentUser($User);
					
					//Phát sinh dữ liệu báo cáo mới nếu chưa có
					$D 	= new \MVC\Library\Date();
					$AD = $D->rangeThisMonth();
															
					$IdTracking = $mTracking->exist(array($AD[0], $AD[1]));
					if ($IdTracking == null){
						$Tracking = new \MVC\Domain\Tracking(
							null,
							$AD[0],
							$AD[1]
						);
						$mTracking->insert($Tracking);
						$Tracking->generateDaily();
					}
					return self::statuses('CMD_OK');
				}else{
					$request->addFeedback("error");
					return self::statuses('CMD_NO_AUTHOR');
				}
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>