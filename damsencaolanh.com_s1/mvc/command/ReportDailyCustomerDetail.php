<?php		
	namespace MVC\Command;	
	class ReportDailyCustomerDetail extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack 	= $request->getProperty('IdTrack');
			$IdTD 		= $request->getProperty('IdTD');
			$IdCustomer = $request->getProperty('IdCustomer');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTC 		= new \MVC\Mapper\TrackingCustomer();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mSession 	= new \MVC\Mapper\Session();
			$mCC 		= new \MVC\Mapper\CollectCustomer();
			$mPC 		= new \MVC\Mapper\PaidCustomer();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 	= $mTracking->find($IdTrack);
			$TD 		= $mTD->find($IdTD);
			$Customer 	= $mCustomer->find($IdCustomer);
			$ConfigName	= $mConfig->findByName("NAME");
			
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView()),
				array($TD->getDatePrint()	, $TD->getURLReportCustomer())
			);
			$Title 	= mb_strtoupper($Customer->getName(), 'UTF8');
			
			//TÍNH NỢ CŨ CỦA KHÁCH HÀNG
			$TCAll = $mTC->findByPre(array($IdTrack, $IdCustomer));
			if ($TCAll->count()==0){
				$TC = new \MVC\Domain\TrackingCustomer(
					null,
					$IdTrack,
					$IdCustomer,
					0,
					0,
					0
				);				
			}else{
				$TC = $TCAll->current();
			}
						
			//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
			$CollectAll = $mCC->findByTracking(array($IdCustomer, $Tracking->getDateStart(), $TD->getDate()));
			$VC = 0;
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$VC += $Collect->getValue();
				$CollectAll->next();
			}
			$NVC = new \MVC\Library\Number($VC);
			
			//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
			$PaidAll = $mPC->findByTracking(array($IdCustomer, $Tracking->getDateStart(), $TD->getDate()));
			$VP = 0;
			while ($PaidAll->valid()){
				$Paid 	= $PaidAll->current();
				$VP 	+= $Paid->getValue();
				$PaidAll->next();
			}
			$NVP = new \MVC\Library\Number($VP);
			
			//TÍNH NỢ MỚI			
			$VO		= $TC->getValue();
			$NVO 	= new \MVC\Library\Number($VO);
			
			$VN		= $VO + $VP - $VC;
			$NVN 	= new \MVC\Library\Number($VN);
			
			//NẾU LÀ NGÀY CUỐI THÁNG THÌ TỔNG KẾT SỔ THÁNG
			if ($TD->getDate() == $Tracking->getDateEnd()){
				$TCAll = $mTC->findBy1(array($IdTrack, $IdCustomer));
				if ($TCAll->count()==0){
					$TC = new \MVC\Domain\TrackingCustomer(
						null,
						$IdTrack,
						$IdCustomer,
						$VP,						
						$VC
					);
					$mTC->insert($TC);
				}else{
					$TC = $TCAll->current();
					$TC->setValuePaid($VP);					
					$TC->setValueCollect($VC);
					$mTC->update($TC);
				}
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'	, $Title);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('Tracking'	, $Tracking);
			$request->setObject('TD'		, $TD);
			$request->setObject('Customer'	, $Customer);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setObject('PaidAll'	, $PaidAll);
			$request->setObject('CollectAll', $CollectAll);
			$request->setObject('NVC'		, $NVC);
			$request->setObject('NVO'		, $NVO);
			$request->setObject('NVP'		, $NVP);
			$request->setObject('NVN'		, $NVN);
		}
	}
?>