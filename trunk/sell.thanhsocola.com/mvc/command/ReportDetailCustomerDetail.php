<?php		
	namespace MVC\Command;	
	class ReportDetailCustomerDetail extends Command{
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
			$IdCustomer = $request->getProperty('IdCustomer');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 	= new \MVC\Mapper\Customer();			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTC 		= new \MVC\Mapper\TrackingCustomer();			
			$mSession 	= new \MVC\Mapper\Session();
			$mCC 		= new \MVC\Mapper\CollectCustomer();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 	= $mTracking->find($IdTrack);			
			$Customer 	= $mCustomer->find($IdCustomer);
			$ConfigName	= $mConfig->findByName("NAME");
			
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())			
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
			$D1 		= $Tracking->getDateStart()." 1:0:0";
			$D2 		= $Tracking->getDateEnd()." 23:59:59";
			$SessionAll = $mSession->findByTrackingCustomer(array($IdCustomer, $D1, $D2));			
			$VS1	=	0;
			$VS2	=	0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();
				if ($Session->getStatus()==1)
					$VS1 += $Session->getValue();
				else if ($Session->getStatus()==2)
					$VS2 += $Session->getValue();
				$SessionAll->next();
			}
			$NVS1 = new \MVC\Library\Number($VS1);
			$NVS2 = new \MVC\Library\Number($VS2);
			
			//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
			$CollectAll = $mCC->findByTracking(array($IdCustomer, $Tracking->getDateStart(), $Tracking->getDateEnd()));
			$VC = 0;
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$VC += $Collect->getValue();
				$CollectAll->next();
			}
			$NVC = new \MVC\Library\Number($VC);
			
			//TÍNH NỢ MỚI			
			$VO	= $TC->getValue();
			$NVO = new \MVC\Library\Number($VO);
			
			$VN	= $VO + $VS2 - $VC;
			$NVN = new \MVC\Library\Number($VN);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'	, $Title);			
			$request->setObject('Navigation', $Navigation);
			$request->setObject('Tracking'	, $Tracking);			
			$request->setObject('Customer'	, $Customer);
			$request->setObject('ConfigName', $ConfigName);
			
			$request->setObject('SessionAll', $SessionAll);
			$request->setObject('CollectAll', $CollectAll);
			$request->setObject('NVS1'		, $NVS1);
			$request->setObject('NVS2'		, $NVS2);
			$request->setObject('NVC'		, $NVC);						
			$request->setObject('NVO'		, $NVO);
			$request->setObject('NVN'		, $NVN);
		}
	}
?>