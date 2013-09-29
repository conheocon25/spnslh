<?php		
	namespace MVC\Command;	
	class PayRollWorkDetail extends Command {
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
			$Date = $request->getProperty('Date');
			$IdEmployee = $request->getProperty('IdEmployee');
			$State = $request->getProperty('State');
			$Minute = $request->getProperty('Minute');
			$Extra = $request->getProperty('Extra');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking = new \MVC\Mapper\Tracking();
			$mEmployee = new \MVC\Mapper\Employee();
			$mPayRoll = new \MVC\Mapper\PayRoll();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$IdPR = $mPayRoll->check(array($IdEmployee, $Date));
			if (!isset($IdPR) || $IdPR==null){
				$PR = new \MVC\Domain\PayRoll(
					null,
					$IdEmployee, 
					$Date, 
					$State=='yes'?1:0,
					0,
					0
				);
				$mPayRoll->insert($PR);
				
			}else{
				$PR = $mPayRoll->find($IdPR);								
				$PR->setState($State=='yes'?1:0);
				if (isset($Minute) && $Minute < 100){ 
					$PR->setLate($Minute);					
				}
				if ($State=='no'){
					$PR->setLate(0);
					$PR->setExtra(0);
				}
				if (isset($Extra)) $PR->setExtra($Extra);
				$mPayRoll->update($PR);
			}			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>