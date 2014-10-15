<?php		
	namespace MVC\Command;	
	class PayRoll extends Command {
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
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$EmployeeAll 	= $mEmployee->findAll();
			$TrackAll 		= $mTracking->findAll();
			$ConfigName		= $mConfig->findByName("NAME");
			
			if (!isset($IdTrack)){
				$Track = $TrackAll->current();
				$IdTrack = $Track->getId();
			}else{
				$Track = $mTracking->find($IdTrack);
			}
			
			$PRAll = $Track->getPayRollAll();
			if ($PRAll->count() == 0){
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
			$PRAll->rewind();
			$SValue = 0;
			while ($PRAll->valid()){
				$PR = $PRAll->current();
				$SValue += $PR->getValue();
				$PRAll->next();
			}
			$NSValue = new \MVC\Library\Number($SValue);
			
			$Title = "CHẤM CÔNG";
			$Navigation = array();
			$URLReset = "/payroll/".$IdTrack."/reset";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', 		$Title);
			$request->setProperty('URLReset', 	$URLReset);
			$request->setObject('TrackAll', 	$TrackAll);
			$request->setObject('EmployeeAll', 	$EmployeeAll);
			$request->setObject('Track', 		$Track);
			$request->setObject('NSValue', 		$NSValue);
			$request->setObject('ConfigName', 	$ConfigName);
			$request->setObject('Navigation', 	$Navigation);
		}
	}
?>