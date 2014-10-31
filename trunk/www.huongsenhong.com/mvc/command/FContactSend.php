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
			
			$OldCodeCaptcha = $Session->getCurrentCaptcha();			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$Name 		= $Data[0];
			$Email 		= $Data[1];
			$Subject 	= $Data[2];
			$Content 	= $Data[3];
			$CodeCaptcha= $Data[4];	
			
			$doMail = new Mail(
						"mail.caytretramdot.com", 
						"admin@caytretramdot.com", 
						"spncom", 
						"admin368189"
					);					
			
			if (isset($Email) && ($OldCodeCaptcha == $CodeCaptcha)) {
				
				$MContent = "Website ẨM THỰC HƯƠNG SEN HỒNG - Gửi phản hồi liên hệ <br /> 
							Người gửi: $Name <br />
							Chủ Đề: $Subject <br />
							Email Người gửi: $Email <br />	
							Nội dung:   $Content<br />";
				
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"tuanbuithanh@gmail.com", 
							$Subject, 
							$MContent
						);
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"huongsenhongdongthap@gmail.com", 
							$Subject, 
							$MContent
						);					
								
				$Data = array('result' => "OK");
				echo json_encode($Data);
				
			}
			else { 
				$data1 = array('result' => "FALSE"); 
				echo json_encode($data1);
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>