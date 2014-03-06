<?php
	namespace MVC\Command;	
	use MVC\Library\Mail;
	class SendMailRegister extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$NameReg = $request->getProperty('NameReg');	
			$EmailReg = $request->getProperty('EmailReg');			
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mUser = new \MVC\Mapper\User();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH Send Mail
			//-------------------------------------------------------------
			$checkMail = null;
			$doMail = new Mail("mail.caytretramdot.com", "admin@caytretramdot.com", "bambo100", "admin068198");
			
			if (isset($EmailReg)) {
				$checkMail = $mUser->checkEmail($EmailReg);
			}
			echo "EmailReg: ".$EmailReg;
			echo "check: ".$checkMail;
			
			if( $checkMail == null ) {
				
				$dUser = new \MVC\Domain\User(
					null,
					$NameReg,
					$EmailReg,
					'123456',
					1,
					'',
					null,
					'',
					'',
					4,
					0
				);			
				$mUser->insert($dUser);
				//gủi mail 
				$Content = "Website Cây Tre Trăm Đốt - caytretramdot.com -  <br />
						Chúc mừng bạn $NameReg - Tài khoản của bạn đã được tạo thành công ! Click vào link bên dưới để đăng nhập vào hệ thống! <br />
						http://caytretramdot.com/dang-nhap  <br />
						Tài khoản: $EmailReg <br />
						Mật khẩu: 123456 <br />
						<br /> Cám ơn bạn đã ủng hộ website chúng tôi!";
			
				$doMail->SendMail("Ban Biên Tập Website http://caytretramdot.com", "admin@caytretramdot.com", $EmailReg, "Website http://caytretramdot.com gửi thư xác nhận đăng ký thành viên", $Content);
				
				$request->setProperty('code', 1);
				
				return self::statuses('CMD_OK');
				
			}
			
			if( $checkMail != null ) {
				$request->setProperty('code', 2);
				return self::statuses('CMD_OK');
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			
		}
	}
?>
