<?php
	namespace MVC\Command;	
	use MVC\Library\Mail;
	class FContactSend extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			
			$Data = $request->getProperty('Data');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$Name 		= $Data[0];
			$Email 		= $Data[1];
			$Subject 	= $Data[2];
			$Content 	= $Data[3];
			
			$doMail = new Mail(
						"mail.caytretramdot.com", 
						"admin@caytretramdot.com", 
						"spncom", 
						"admin368189"
					);
			
			if (isset($Email)) {				
				$MContent = "Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ <br /> 
							Người gửi: $Name <br />
							Email Người gửi: $Email <br />	
							Nội dung:   $Content<br />";
							
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"tuanbuithanh@gmail.com", 
							$Subject, 
							$MContent
						);				
						
				$json = array('result' => "OK");
				echo json_encode($json);
			}else { $json = array('result' => "FALSE"); echo json_encode($json);}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>