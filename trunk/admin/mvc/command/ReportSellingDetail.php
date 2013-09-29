<?php		
	namespace MVC\Command;	
	class ReportSellingDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			$Type = $request->getProperty('Type');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSession = new \MVC\Mapper\Session();
			$mTracking = new \MVC\Mapper\Tracking();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "NHẬT KÍ BÁN HÀNG";
			$arrTime = array(
				"today"		=> 	@\MVC\Library\Date::rangeToday(),
				"yesterday"	=>	@\MVC\Library\Date::rangeYesterday(),
				"thisweek"	=>	@\MVC\Library\Date::rangeThisWeek(), 
				"lastweek"	=>	@\MVC\Library\Date::rangeBeforeWeek(),
				"thismonth"	=>	@\MVC\Library\Date::rangeThisMonth(),
				"lastmonth"	=>	@\MVC\Library\Date::rangeBeforeMonth()
			);
			$Tracking = $mTracking->find($Type);
			
			//$DateStart = $arrTime[$Type][0];
			//$DateEnd = $arrTime[$Type][1];
						
			if (isset($Tracking)){
				$DateStart = $Tracking->getDateStart();
				$DateEnd = $Tracking->getDateEnd();
			}
			
			if ( \strtotime($Type)== true){
				$DateStart = $Type;
				$DateEnd = $Type;
			}
						
			$Date = $DateStart;
			$Total = 0;
			$DataAll = array();						
			while (strtotime($Date) <= strtotime($DateEnd)){								
				
				//THỐNG KÊ THEO CA 1 TỪ 6H SÁNG ĐẾN 2H CHIỀU
				$Date1 = \date("Y-m-d", strtotime($Date))." 06:00:00";
				$Date2 = \date("Y-m-d", strtotime($Date))." 13:59:59";
				$SessionAll = $mSession->findByTracking( array($Date1, $Date2 ) );
				
				$Value = 0;				
				$SubData = array();
				while ($SessionAll->valid()){
					$Session = $SessionAll->current();										
					$Value += ($Session->getStatus()==1?$Session->getValue():0);
					$R = array(
						$Session->getId(),
						$Session->getTimeRangePrint(),
						$Session->getUser()->getName(),
						$Session->getTable()->getDomain()->getName(),
						$Session->getTable()->getName(),
						$Session->getNote(),
						$Session->getStatus()==1?$Session->getValuePrint():0
					);
					$SubData[] = $R;
					
					$SessionAll->next();
				}								
				$Sum = new \MVC\Library\Number($Value);
				
				$DateCurrent = new \DateTime($Date);
				$DataAll[] = array(
						$DateCurrent->format('d/m/Y')." CA 1",
						$SubData, 						
						$Sum->formatCurrency()." đ"
				);
				$Total += $Value;
								
				//THỐNG KÊ THEO CA 2 TỪ 2H CHIỀU ĐẾN 11H TỐI
				$Date1 = \date("Y-m-d", strtotime($Date))." 14:00:00";
				$Date2 = \date("Y-m-d", strtotime($Date))." 22:59:59";
				$SessionAll = $mSession->findByTracking( array($Date1, $Date2 ) );
				
				$Value = 0;				
				$SubData = array();
				while ($SessionAll->valid()){
					$Session = $SessionAll->current();										
					$Value += ($Session->getStatus()==1?$Session->getValue():0);
					$R = array(
						$Session->getId(),
						$Session->getTimeRangePrint(),
						$Session->getUser()->getName(),
						$Session->getTable()->getDomain()->getName(),
						$Session->getTable()->getName(),
						$Session->getNote(),
						$Session->getStatus()==1?$Session->getValuePrint():0
					);
					$SubData[] = $R;
					
					$SessionAll->next();
				}
				$Sum2 = new \MVC\Library\Number($Value);
				$DataAll[] = array(
						$DateCurrent->format('d/m/Y')." CA 2",
						$SubData, 						
						$Sum2->formatCurrency()." đ"
				);
				$Total += $Value;
					
				$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
			}
			$NTotal = new \MVC\Library\Number($Total);
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			$request->setObject('NTotal', $NTotal);
			$request->setObject('DataAll', $DataAll);
		}
	}
?>