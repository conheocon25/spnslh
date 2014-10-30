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
			$gmail = new \PHPMailer();		
			$json = array('result' => "FALSE");
			if (isset($Email) && ($OldCodeCaptcha == $CodeCaptcha)) {
				//gửi mail từ hệ thống website về huongsenhongdongthap.com
				$MContent = "Website ẨM THỰC HƯƠNG SEN HỒNG - Gửi phản hồi liên hệ <br /> 
							Người gửi: $Name <br />
							Chủ Đề: $Subject <br />
							Email Người gửi: $Email <br />	
							Nội dung:   $Content<br />";
							
				
						
				//gửi bằng Gmail huongsenhongdongthap@gmail.com
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
				$gmail->Username = "huongsenhongdongthap@gmail.com";
				$gmail->Password = "truongquangthai";
				$gmail->SetFrom("Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!");
				$gmail->Subject = "Website ẨM THỰC LÀNG SEN - Đã nhận được phản hồi liên hệ của bạn!";
				$gmail->Body = $gMailContent;
				$gmail->AddAddress($Email, $Name);				
				
				$gmail->Send();
				
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"thanhbao2007vl@gmail.com", 
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