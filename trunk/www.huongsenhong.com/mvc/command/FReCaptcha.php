<?php
	namespace MVC\Command;		
	require_once("mvc/library/recaptchalib.php");
	
	class FReCaptcha extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Privatekey = '6LfT6vsSAAAAAFJ0oBZZuJyqWDjFALiirteh_whc';
			
			$CodeChallenge = $request->getProperty('CodeChallenge');
			$CodeResponse = $request->getProperty('CodeResponse');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			
			//$RC_challenge 		= $Data[0];
			//$RC_response 		= $Data[1];
			
			$json = array('result' => "FALSE");
			
			if (isset($CodeChallenge)) {				
				$resp = \recaptcha_check_answer($Privatekey,
												$_SERVER["REMOTE_ADDR"],
												$CodeChallenge,
												$CodeResponse);

				if ($resp->is_valid) {
						$json = array('result' => "OK");
						echo json_encode($json);
				} else {					
						$json = array('result' => "FALSE");
						echo json_encode($json);
				}				
			}else { $json = array('result' => "FALSE"); echo json_encode($json);}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>