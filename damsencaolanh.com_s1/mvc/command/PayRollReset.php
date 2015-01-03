<?php		
	namespace MVC\Command;	
	class PayRollReset extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack = $request->getProperty('IdTrack');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mPayRoll 	= new \MVC\Mapper\PayRoll();
			$mEmployee 	= new \MVC\Mapper\Employee();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mPayRoll->deleteByTracking(array($IdTrack));
			
			$EmployeeAll 	= $mEmployee->findAll();			
			$Track = $mTracking->find($IdTrack);
						
			while ($EmployeeAll->valid()){
				$Employee = $EmployeeAll->current();
				$PR = new \MVC\Domain\PayRoll(
					null,
					$Employee->getId(),
					$IdTrack,
					0,
					$Employee->getSalaryBase(),
					0,
					0,
					'Ghi chú'
				);			
				$mPayRoll->insert($PR);
				$EmployeeAll->next();
			}
									
		}
	}
?>