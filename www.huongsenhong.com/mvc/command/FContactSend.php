<?php
	namespace MVC\Command;	
	require_once("mvc/library/class.phpmailer.php");
	require_once("mvc/library/class.smtp.php");
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
						
			$doMail = new \Mail(
						"mail.caytretramdot.com", 
						"admin@caytretramdot.com", 
						"spncom", 
						"admin368189"
					);
					
			
			if (isset($Email)) {
				//gửi mail từ hệ thống website về amthuclangsen.com
				$MContent = "Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ <br /> 
							Người gửi: $Name <br />
							Chủ Đề: $Subject <br />
							Email Người gửi: $Email <br />	
							Nội dung:   $Content<br />";
							
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"thanhbao2007vl@gmail.com", 
							$Subject, 
							$MContent
						);
						
				//gửi bằng Gmail amthuclangsen@gmail.com
				$gMailContent = "Kính chào quí khách, <br />
								Chúng tôi đã nhận được nội dung phản hồi quí khách, chúng tôi sẽ nhanh chóng có hồi đáp sớm nhất có thể. <br />
								Cảm ơn vì đã phản hồi !";
				$mail = new \PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPDebug = 1;
				$mail->SMTPAuth = true;
				$mail->CharSet="UTF-8";
				$mail->IsHTML(true);
				$mail->SMTPSecure = 'tls';
				$mail->Host = "smtp.gmail.com";	
				$mail->Port = 587;			
				$mail->Username = "amthuclangsen@gmail.com";
				$mail->Password = "truongquangthai";
				$mail->SetFrom("Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!");
				$mail->Subject = "Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!";
				$mail->Body = $gMailContent;
				$mail->AddAddress($Email, $Name);				
				
				if(!$mail->Send())
					{
					echo "Mailer Error: " . $mail->ErrorInfo;
					}
					else
					{
					echo "Message has been sent";
					}
				
				$json = array('result' => "OK");
				echo json_encode($json);
			}else { $json = array('result' => "FALSE"); echo json_encode($json);}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>