<?php		
	namespace MVC\Command;	
	class AReportDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack = $request->getProperty("IdTrack");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking 	= new \MVC\Mapper\Tracking();			
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking = $mTracking->find($IdTrack);
			$TrackingAll = $mTracking->findAll();
			
			$TDAll = $Tracking->getDailyAll();
			if ($TDAll->count()==0){
				$Tracking->generateDaily();
			}
			
			$STicket1 		= 0;
			$STicket2 		= 0;
			$STicketD 		= 0;
			$STicketValue 	= 0;
			$SPaid1 		= 0;
			$SPaid1Remain	= 0;
			$SPaid2 		= 0;
			$SDebt 			= 0;
			$SPaid2Remain	= 0;
			$SValue			= 0;
			
			while ($TDAll->valid()){
				$TD = $TDAll->current();
				$STicket1 		+= $TD->getTicket1();
				$STicket2 		+= $TD->getTicket2();
				$STicketD 		+= $TD->getTicketD();
				$STicketValue 	+= $TD->getTicketValue();
				$SPaid1 		+= $TD->getPaid1();
				$SPaid1Remain 	+= $TD->getPaid1Remain();
				$SPaid2 		+= $TD->getPaid2();
				$SDebt 			+= $TD->getDebt();
				$SPaid2Remain	+= $TD->getPaid2Remain();
				$SValue			+= $TD->getValue();
				
				$TDAll->next();
			}
			$NSTicket1 		= new \MVC\Library\Number($STicket1);
			$NSTicket2 		= new \MVC\Library\Number($STicket2);
			$NSTicketD 		= new \MVC\Library\Number($STicketD);
			$NSTicketValue 	= new \MVC\Library\Number($STicketValue);
			$NSPaid1	 	= new \MVC\Library\Number($SPaid1);
			$NSPaid1Remain 	= new \MVC\Library\Number($SPaid1Remain);
			$NSPaid2	 	= new \MVC\Library\Number($SPaid2);
			$NSDebt		 	= new \MVC\Library\Number($SDebt);
			$NSPaid2Remain 	= new \MVC\Library\Number($SPaid2Remain);
			$NSValue	 	= new \MVC\Library\Number($SValue);
			
			$Title = $Tracking->getName();
			$Navigation = array(				
				array("BÁO CÁO", "/report")
			);
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('STicket1'	, $NSTicket1->formatCurrency() );
			$request->setProperty('STicket2'	, $NSTicket2->formatCurrency() );
			$request->setProperty('STicketD'	, $NSTicketD->formatCurrency() );
			$request->setProperty('STicketValue', $NSTicketValue->formatCurrency() );
			$request->setProperty('SPaid1'		, $NSPaid1->formatCurrency() );
			$request->setProperty('SPaid1Remain', $NSPaid1Remain->formatCurrency() );
			$request->setProperty('SPaid2'		, $NSPaid2->formatCurrency() );
			$request->setProperty('SDebt'		, $NSDebt->formatCurrency() );
			$request->setProperty('SPaid2Remain', $NSPaid2Remain->formatCurrency() );
			$request->setProperty('SValue'		, $NSValue->formatCurrency() );
			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TrackingAll'	, $TrackingAll);
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('ConfigName'	, $ConfigName);
						
		}
	}
?>