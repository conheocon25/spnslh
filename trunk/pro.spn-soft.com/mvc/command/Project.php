<?php
	namespace MVC\Command;	
	class Project extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "CÔNG CỤ LẬP TRÌNH TRỰC TUYẾN";						
						
			//$result = exec('gcc data\code\c\hello.c', $output, $return_value);
			$result = exec('gcc data\code\c\hello.c 2>$1', $output, $return_value);
			echo "Message ".$result;
			echo $return_value;
			print_r($output);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", $Title);
			$request->setProperty("URLHeader", '/signin/load');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>