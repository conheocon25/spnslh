<?php		
	namespace MVC\Command;	
	class SettingInitMove extends Command {
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
			$mStudentTemp 	= new \MVC\Mapper\StudentTemp();
			$mStudent 		= new \MVC\Mapper\Student();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			
			//Xóa hết dữ liệu cũ
			//$mStudentTemp->deleteAll(array());
			$StudentTempAll = $mStudentTemp->findAll();
			while ($StudentTempAll->valid()){
				$StudentTemp = $StudentTempAll->current();
				$Student = new \MVC\Domain\Student(
					null,
					$StudentTemp->getCode(),
					$StudentTemp->getSurName(),
					$StudentTemp->getLastName(),
					$StudentTemp->getCodeExt1(),
					$StudentTemp->getBirthday(),
					$StudentTemp->getGender(),
					$StudentTemp->getClass()->getId()
				);
				$mStudent->insert($Student);
				
				$StudentTempAll->next();
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>