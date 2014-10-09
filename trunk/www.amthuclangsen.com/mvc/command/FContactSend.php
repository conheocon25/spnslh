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
			$doGMail = new Mail(
						"smtp.gmail.com", 
						"smtp.gmail.com", 
						"amthuclangsen@gmail.com", 
						"truongquangthai"
					);
			
			if (isset($Email)) {				
				$MContent = "Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ <br /> 
							Người gửi: $Name <br />
							Email Người gửi: $Email <br />	
							Nội dung:   $Content<br />";
							
				$doMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"admin@caytretramdot.com", 
							"thanhbao2007vl@gmail.com", 
							$Subject, 
							$MContent
						);
						
				$doGMail->SendMail(
							"Website ẨM THỰC LÀNG SEN - Gửi phản hồi liên hệ", 
							"amthuclangsen@gmail.com", 
							$Email, 
							"Chúng tôi đã nhận được phản hồi của bạn", 
							"Kính chào quí khách, <br /> 
							Chúng tôi đã nhận được nội dung phản hồi quí khách từ amthuclangsen@gmail.com, chúng tôi sẽ nhanh chóng có hồi đáp sớm nhất có thể. <br />
							Cảm ơn vì đã phản hồi !"
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