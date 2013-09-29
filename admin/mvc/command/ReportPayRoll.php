<?php		
	namespace MVC\Command;	
	class ReportPayRoll extends Command {
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
			$mEmployee = new \MVC\Mapper\Employee();
			$mTracking = new \MVC\Mapper\Tracking();
			$mPR = new \MVC\Mapper\PayRoll();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Config5Minutes = $mConfig->findByName('EVERY_5_MINUTES');
			$EmployeeAll = $mEmployee->findAll();
			$Tracking = $mTracking->find($IdTrack);
			
			$Data = array();
			$Sum = 0;
			while ($EmployeeAll->valid()){
				$Employee = $EmployeeAll->current();				
				$DayValue = $Employee->getSalaryBase()/30;
				$PRAll = $mPR->findByTracking(array($Employee->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
				$Extra = 0;
				$Late = 0;
				$Absent = 0;
				$PRAll->rewind();
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
				
				//Thêm vào danh sách tạm
				$Data[] = array( 
									$Employee->getName(), 
									$Employee->getSalaryBasePrint(), 
									$NExtraValue->formatCurrency(), 
									$NAbsentValue->formatCurrency(), 
									$NLateValue->formatCurrency(), 
									$NSalary->formatCurrency() 
						);
				$Sum += $Salary;
				$EmployeeAll->next();
			}			
			$NSum = new \MVC\Library\Number($Sum);
			
			$Title = "LƯƠNG ".$Tracking->getName();
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			$request->setObject('Data', $Data);
			$request->setObject('Sum', $NSum);
		}
	}
?>