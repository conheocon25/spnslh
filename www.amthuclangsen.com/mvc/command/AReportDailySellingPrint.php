<?php		
	namespace MVC\Command;	
	class AReportDailySellingPrint extends Command {
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
			$IdDomain 	= $request->getProperty('IdDomain');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain 	= new \MVC\Mapper\Domain();			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mCL 		= new \MVC\Mapper\CustomerLog();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigPhone 	= $mConfig->findByName("PHONE");
			$ConfigAddress 	= $mConfig->findByName("ADDRESS");
			
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
						
			$Domain = $mDomain->find($IdDomain);
						
			$CLAll = $mCL->findByDate1(array($IdDomain, $TD->getDate()));
			$STicket1 		= 0;
			$STicket2 		= 0;
			$STicketD 		= 0;
			$STicketValue 	= 0;			
			$SPaid1 		= 0;
			$SPaid1Remain 	= 0;
			$SPaid2 		= 0;
			$SPaid2Remain 	= 0;
			$SDebt 			= 0;
			$SValue 		= 0;
			
			while ($CLAll->valid()){
				$CL = $CLAll->current();
				
				$STicket1 		+= $CL->getTicket1();
				$STicket2 		+= $CL->getTicket2();
				$STicketD 		+= $CL->getTicketD();
				$STicketValue 	+= $CL->getTicketValue();
				$SPaid1 		+= $CL->getPaid1();
				$SPaid1Remain	+= $CL->getPaid1Remain();
				$SPaid2 		+= $CL->getPaid2();
				$SPaid2Remain	+= $CL->getPaid2Remain();
				$SDebt 			+= $CL->getDebt();
				$SValue			+= $CL->getValue();
				$CLAll->next();
			}
			$NSTicket1 		= new \MVC\Library\Number($STicket1);
			$NSTicket2 		= new \MVC\Library\Number($STicket2);
			$NSTicketD 		= new \MVC\Library\Number($STicketD);
			$NSTicketValue 	= new \MVC\Library\Number($STicketValue);
			$NSPaid1 		= new \MVC\Library\Number($SPaid1);
			$NSPaid1Remain 	= new \MVC\Library\Number($SPaid1Remain);
			$NSPaid2 		= new \MVC\Library\Number($SPaid2);
			$NSPaid2Remain 	= new \MVC\Library\Number($SPaid2Remain);
			$NSDebt 		= new \MVC\Library\Number($SDebt);
			$NSValue 		= new \MVC\Library\Number($SValue);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('STicket1'	, $NSTicket1->formatCurrency());
			$request->setProperty('STicket2'	, $NSTicket2->formatCurrency());
			$request->setProperty('STicketD'	, $NSTicketD->formatCurrency());
			$request->setProperty('STicketValue', $NSTicketValue->formatCurrency());
			$request->setProperty('SPaid1'		, $NSPaid1->formatCurrency());
			$request->setProperty('SPaid1Remain', $NSPaid1Remain->formatCurrency());
			$request->setProperty('SPaid2'		, $NSPaid2->formatCurrency());
			$request->setProperty('SPaid2Remain', $NSPaid2Remain->formatCurrency());
			$request->setProperty('SDebt'		, $NSDebt->formatCurrency());
			$request->setProperty('SValue'		, $NSValue->formatCurrency());
			
			$request->setObject('CLAll'			, $CLAll);
			$request->setObject('TD'			, $TD);
			$request->setObject('Domain'		, $Domain);
						
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
		}
	}
?>