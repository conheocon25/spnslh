<?php		
	namespace MVC\Command;	
	class SettingInit extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mConfig = new \MVC\Mapper\Config();
			$mStudentTemp = new \MVC\Mapper\StudentTemp();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$ConfigName = $mConfig->findByName("NAME");
			$StudentTempAll = $mStudentTemp->findAll();
						
			$Title = "KHỞI TẠO";
			$Navigation = array(array("THIẾT LẬP", "/setting"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);			
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('StudentTempAll', 	$StudentTempAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>