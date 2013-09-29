<?php		
	namespace MVC\Command;	
	class ReportSellingGeneral extends Command{
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
			$mTracking = new \MVC\Mapper\Tracking();			
			$mSession = new \MVC\Mapper\Session();
			$mPaidGeneral = new \MVC\Mapper\PaidGeneral();
			$mCollectGeneral = new \MVC\Mapper\CollectGeneral();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Tracking = $mTracking->find($IdTrack);
			
			$ChartData = array();
			$Date = $Tracking->getDateStart();
			$EndDate = $Tracking->getDateEnd();
			$Sum1 = 0;
			$Sum2 = 0;
			$Sum3 = 0;
			$Sum4 = 0;
			$Sum5 = 0;
			$Sum6 = 0;
			
			while (strtotime($Date) <= strtotime($EndDate)){
				$Date1 = \date("Y-m-d", strtotime($Date))." 06:00:00";
				$Date2 = \date("Y-m-d", strtotime($Date))." 22:59:59";				
				$Value1 = 0;
				$Value2 = 0;
				$Value3 = 0;
				$Value4 = 0;
				$Value5 = 0;
				$Value6 = 0;
				
				//TÍNH DOANH SỐ
				$SessionAll = $mSession->findByTracking( array($Date1, $Date2) );
				while($SessionAll->valid()){
					$Session = $SessionAll->current();										
					$Value1 += $Session->getValue();
					$Value2 += $Session->getValueBase();
					$Value3 += $Session->getValue() - $Session->getValueBase();
					$SessionAll->next();
				}
				
				//TÍNH TỔNG THU
				$CollectAll = $mCollectGeneral->findByTracking( array($Date, $Date) );
				while($CollectAll->valid()){
					$Collect = $CollectAll->current();										
					$Value4 += $Collect->getValue();					
					$CollectAll->next();
				}
				
				//TÍNH TỔNG CHI
				$PaidAll = $mPaidGeneral->findByTracking( array($Date, $Date) );
				while($PaidAll->valid()){
					$Paid = $PaidAll->current();										
					$Value5 += $Paid->getValue();					
					$PaidAll->next();
				}
				
				//TÍNH LÃI TRONG NGÀY
				$Value6 = $Value3 + $Value4 - $Value5;
				
				//Định dạng lại gọn				
				$N1 = new \MVC\Library\Number($Value1);
				$N2 = new \MVC\Library\Number($Value2);
				$N3 = new \MVC\Library\Number($Value3);
				$N4 = new \MVC\Library\Number($Value4);
				$N5 = new \MVC\Library\Number($Value5);
				$N6 = new \MVC\Library\Number($Value6);
				
				$ChartData[] = array(
					\date("d/m", strtotime($Date)),
					$N1->formatCurrency()." đ",
					$N2->formatCurrency()." đ",
					$N3->formatCurrency()." đ",
					$N4->formatCurrency()." đ",
					$N5->formatCurrency()." đ",
					$N6->formatCurrency()." đ"
				);
				$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
				$Sum1 += $Value1;
				$Sum2 += $Value2;
				$Sum3 += $Value3;
				$Sum4 += $Value4;
				$Sum5 += $Value5;
				$Sum6 += $Value6;
			}
			$NSum1 = new \MVC\Library\Number($Sum1);
			$NSum2 = new \MVC\Library\Number($Sum2);
			$NSum3 = new \MVC\Library\Number($Sum3);
			$NSum4 = new \MVC\Library\Number($Sum4);
			$NSum5 = new \MVC\Library\Number($Sum5);
			$NSum6 = new \MVC\Library\Number($Sum6);
			
			$Title = "DOANH THU THÁNG ".\date("m/Y", strtotime($EndDate));
			$DateCurrent = "Vĩnh Long, ngày ".\date("d")." tháng ".\date("m")." năm ".\date("Y");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('ChartData', $ChartData);			
			$request->setProperty('Title', $Title);
			$request->setProperty('DateCurrent', $DateCurrent);
			$request->setProperty('Sum1', $NSum1->formatCurrency()." đ");
			$request->setProperty('Sum2', $NSum2->formatCurrency()." đ");
			$request->setProperty('Sum3', $NSum3->formatCurrency()." đ");
			$request->setProperty('Sum4', $NSum4->formatCurrency()." đ");
			$request->setProperty('Sum5', $NSum5->formatCurrency()." đ");
			$request->setProperty('Sum6', $NSum6->formatCurrency()." đ");
		}
	}
?>