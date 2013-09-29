<?php		
	namespace MVC\Command;	
	class ReportPayRollDetail extends Command {
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
			$IdEmployee = $request->getProperty('IdEmployee');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mEmployee = new \MVC\Mapper\Employee();
			$mTracking = new \MVC\Mapper\Tracking();
			$mPR = new \MVC\Mapper\PayRoll();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Config5Minutes = $mConfig->findByName('EVERY_5_MINUTES');			
			$Employee = $mEmployee->find($IdEmployee);
			$DayValue = $Employee->getSalaryBase()/30;
			
			$Tracking = $mTracking->find($IdTrack);
			$PRAll = $mPR->findByTracking(array($IdEmployee, $Tracking->getDateStart(), $Tracking->getDateEnd()));
			
			$Extra = 0;
			$Late = 0;
			$Absent = 0;
			while ($PRAll->valid()){
				$PR = $PRAll->current();
				$Extra += $PR->getExtra();
				$Absent += $PR->getState()==0?1:0;
				$Late += $PR->getLate();
				$PRAll->next();
			}
			
			//Tính thời gian trễ
			$LateValue = ($Late/5)*$Config5Minutes->getValue();
			$NLateValue = new \MVC\Library\Number($LateValue);
			
			//Tính làm thêm
			$ExtraValue = $Extra*$DayValue;
			$NExtraValue = new \MVC\Library\Number($ExtraValue);
			
			//Tính nghỉ ca
			$AbsentValue = $Absent*$DayValue;
			$NAbsentValue = new \MVC\Library\Number($AbsentValue);
			
			//Tổng lương
			$Salary = $Employee->getSalaryBase() + $ExtraValue - $AbsentValue - $LateValue;
			$NSalary = new \MVC\Library\Number($Salary);
			
			$Title = "LƯƠNG ".$Tracking->getName()." - ".mb_strtoupper($Employee->getName(), 'UTF8');			
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			
			$request->setProperty('Extra', $Extra);
			$request->setProperty('ExtraValue', $NExtraValue->formatCurrency() );
			$request->setProperty('Absent', $Absent);
			$request->setProperty('AbsentValue', $NAbsentValue->formatCurrency() );
			$request->setProperty('Late', $Late);
			$request->setProperty('LateValue', $NLateValue->formatCurrency() );
			$request->setProperty('Salary', $NSalary->formatCurrency() );
									
			$request->setObject('Employee', $Employee);
			$request->setObject('PRAll', $PRAll);
		}
	}
?>