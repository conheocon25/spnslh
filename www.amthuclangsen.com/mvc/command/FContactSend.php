<?php
	namespace MVC\Command;
	use MVC\Library\Mail;	
	require_once("mvc/library/class.phpmailer.php");
	require_once("mvc/library/class.smtp.php");
	
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
			$gmail = new \PHPMailer();		
			
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
								
				
				$gmail->IsSMTP();
				$gmail->SMTPDebug = 1;
				$gmail->SMTPAuth = true;
				$gmail->CharSet="UTF-8";
				$gmail->IsHTML(true);
				$gmail->SMTPSecure = 'tls';
				$gmail->Host = "smtp.gmail.com";	
				$gmail->Port = 587;			
				$gmail->Username = "amthuclangsen@gmail.com";
				$gmail->Password = "truongquangthai";
				$gmail->SetFrom("Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!");
				$gmail->Subject = "Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!";
				$gmail->Body = $gMailContent;
				$gmail->AddAddress($Email, $Name);				
				
				if(!$gmail->Send())
					{
					echo "Mailer Error: " . $gmail->ErrorInfo;
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