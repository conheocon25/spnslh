<?php		
	namespace MVC\Command;	
	class SettingInitFalse extends Command {
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
			$mConfig 		= new \MVC\Mapper\Config();
			$mStudentTemp 	= new \MVC\Mapper\StudentTemp();
			$mTable 		= new \MVC\Mapper\Table();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName	= $mConfig->findByName("NAME");
						
			$StudentTempAll = $mStudentTemp->findAll();
			$TableAll 		= $mTable->findAll();
			
			$Valid = 0;
			$StudentTempAll1 = new \MVC\Mapper\StudentTempCollection();
			while ($StudentTempAll->valid()){
				$ST = $StudentTempAll->current();
				if ($ST->checkClass()==false){
					$StudentTempAll1->add($ST);
					$Valid += 1;
				} 
				$StudentTempAll->next();		
			}
									
			$Title = "SAI THÔNG TIN (".$Valid."/".$StudentTempAll->count()." học sinh)";
			$Navigation = array(
				array("THIẾT LẬP", "/setting"),
				array("KHỞI TẠO", "/setting/init")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);						
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('StudentTempAll', 	$StudentTempAll1);
			$request->setObject('TableAll', 		$TableAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>