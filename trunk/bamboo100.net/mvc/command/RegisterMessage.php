<?php
	namespace MVC\Command;	
	class RegisterMessage extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
			$KeyCode = $request->getProperty('code');
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$StrMes = "";
			$Code = false;
			if ( $KeyCode == 1 ) {
				$StrMes = " Tài khoản của bạn đã tạo thành công! Kiểm tra email để đăng nhập vào hệ thống! "; 
				$Code = false;
			}
			if ( $KeyCode == 2 ) {
				$StrMes = " Email đã tồn tại dùng một email khác để đăng ký vào hệ thống! "; 
				$Code = true;
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 'Trang chủ');
			$request->setProperty('StrMes', $StrMes);
			$request->setProperty('Code', $Code);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>