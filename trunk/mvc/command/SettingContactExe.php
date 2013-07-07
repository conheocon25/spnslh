<?php
	namespace MVC\Command;	
	use MVC\Library\Mail;
	class SettingContactExe extends Command {
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
			$Name = $request->getProperty('Name');	
			$Content = $request->getProperty('Content');
			$CodeCaptcha = $request->getProperty('CodeCaptcha');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mUser = new \MVC\Mapper\User();			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$OldCodeCaptcha = $Session->getCurrentCaptcha();
			//echo $OldCodeCaptcha. " == " . $CodeCaptcha;
			if ($OldCodeCaptcha == $CodeCaptcha)
			{				
				if (!isset($Email)) {				
					return self::statuses('CMD_ERROR');
				}
				else {
					
					$Today = \getdate();
					$CurDateTime = $Today['year']."-".$Today['mon']."-".$Today['mday']." ".$Today['hours'].":".$Today['minutes'].":".$Today['seconds'];
					//Gửi mail về Admin
					$AdminMailName = "Sai Gon Land House";
					$AdminMail ="contact@123app.net";			
					$MailSubject = "Ngày $CurDateTime - $Name đã gửi Thư hỏi! ";
					$MailContent = "Người yêu cầu: $Name <br /> Nội dung: $Content";
					//Mail($smtp_host, $admin_email, $smtp_username, $smtp_password);
					$mMail = new Mail('localhost', 'contact@123app.net', 'contact@123app.net', 'admin123456');					
					$mMail->SendMail( $AdminMailName, $AdminMail, 'tuanbuithanh@gmail.com', $MailSubject, $MailContent);
					$mMail->SendMail( $AdminMailName, $AdminMail, 'nhonphamhai@gmail.com', $MailSubject, $MailContent);
					$request->setProperty("MsgCaptcha", '');
					return self::statuses('CMD_OK');
				}
				
			}
			else
			{
				$request->setProperty("MsgCaptcha", 'Mã bảo mật không đúng!');
				return self::statuses('CMD_ERROR');
			}
			return self::statuses('CMD_ERROR');
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>