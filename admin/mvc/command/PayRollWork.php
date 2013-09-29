<?php		
	namespace MVC\Command;	
	class PayRollWork extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking = new \MVC\Mapper\Tracking();
			$mEmployee = new \MVC\Mapper\Employee();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Track = $mTracking->find($IdTrack);			
			$EmployeeAll  = $mEmployee->findAll();
			
			$NDate = new \MVC\Library\Date($Date);
			$Title = "Ngày " . $NDate->getDateFormat();
			$Navigation = array(
				array("Chấm Công", $Track->getURLPayRoll() )
			);
			$URLBase = "/payroll/".$Track->getId()."/".$Date;
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);
			$request->setProperty('Date', $Date);
			$request->setProperty('URLBase', $URLBase);
			$request->setObject('Track', $Track);
			$request->setObject('EmployeeAll', $EmployeeAll);
			$request->setObject('Navigation', $Navigation);
		}
	}
?>