<?php		
	namespace MVC\Command;	
	class ReportDailySellingExe extends Command{
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
			$CLAll = $mCL->findByDate(array($TD->getDate()));
			
			$STicket1 		= 0;
			$STicket2 		= 0;
			$SPaid1 		= 0;
			$SPaid2 		= 0;
			$SDebt	 		= 0;
			$SPaid1Remain	= 0;
			$SPaid2Remain 	= 0;
			$SValue 		= 0;
				
			while ($CLAll->valid()){
				$CL = $CLAll->current();
				$STicket1 		+= $CL->getTicket1();					
				$STicket2 		+= $CL->getTicket2();
				$SDebt 			+= $CL->getDebt();
				$SPaid1 		+= $CL->getPaid1();					
				$SPaid2 		+= $CL->getPaid2();
				$SPaid1Remain 	+= $CL->getPaid1Remain();					
				$SPaid2Remain 	+= $CL->getPaid2Remain();
				
				$CLAll->next();
			}
			$TD->setTicket1($STicket1);
			$TD->setTicket2($STicket2);
			$TD->setPaid1($SPaid1);
			$TD->setPaid2($SPaid2);
			$TD->setDebt($SDebt);
			$TD->setPaid1Remain($SPaid1Remain);
			$TD->setPaid2Remain($SPaid2Remain);
						
			$mTD->update($TD);			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------					
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>