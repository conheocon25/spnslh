<?php		
	namespace MVC\Command;	
	class SettingInitMove extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$fDel = $request->getProperty('fDel');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mStudentTemp 	= new \MVC\Mapper\StudentTemp();
			$mStudent 		= new \MVC\Mapper\Student();
			$mSession 		= new \MVC\Mapper\Session();
			$mTracking 		= new \MVC\Mapper\Tracking();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			\ini_set('max_execution_time', 300); //300 seconds = 5 minutes
			
			$Tracking = $mTracking->findAll()->current();
			if ($fDel == 1){				
				$mStudent->deleteAll(array());
				$mSession->deleteAll(array());
			}
									
			$StudentTempAll = $mStudentTemp->findAll();
			while ($StudentTempAll->valid()){
				$StudentTemp = $StudentTempAll->current();
				$Student = new \MVC\Domain\Student(
					$StudentTemp->getId(),
					$StudentTemp->getCode(),
					$StudentTemp->getSurName(),
					$StudentTemp->getLastName(),
					$StudentTemp->getCodeExt1(),
					$StudentTemp->getBirthday(),
					$StudentTemp->getGender(),
					$StudentTemp->getClass()->getId()
				);
				$mStudent->insert($Student);
				
				//Tạo giao dịch sẵn
				$Session = new \MVC\Domain\Session(
					null,
					$Tracking->getId(),
					$Student->getId(),
					$StudentTemp->getDateJoined(),
					$StudentTemp->getCountMonth(),
					1
				);
				$mSession->insert($Session);
				
				$StudentTempAll->next();
			}
			
			if ($fDel == 1){
				$mStudentTemp->deleteAll(array());				
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>