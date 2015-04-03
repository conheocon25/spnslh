<?php		
	namespace MVC\Command;	
	class BranchReportTrackDailyCustomerViewPrint extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey 		= $request->getProperty('IdKey');
			$IdTrack 	= $request->getProperty('IdTrack');
			$IdTDB 		= $request->getProperty('IdTDB');
			$IdTDBC 	= $request->getProperty('IdTDBC');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 					= new \MVC\Mapper\Config();
			$mBranch 					= new \MVC\Mapper\Branch();
			$mTrack 					= new \MVC\Mapper\Track();
			$mTrackDailyBranch 			= new \MVC\Mapper\TrackDailyBranch();
			$mTrackDailyBranchCustomer 	= new \MVC\Mapper\TrackDailyBranchCustomer();
			$mInvoiceSell 				= new \MVC\Mapper\InvoiceSell();
			$mCustomerCollect			= new \MVC\Mapper\CustomerCollect();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Branch		= $mBranch->findByKey($IdKey);
			$Track 		= $mTrack->find($IdTrack);
			$TDB		= $mTrackDailyBranch->find($IdTDB);
			$TDBC		= $mTrackDailyBranchCustomer->find($IdTDBC);
			$Customer	= $TDBC->getCustomer();
			$Date		= $TDB->getDate();
									
			$InvoiceAll = $mInvoiceSell->findByCustomerDate(array($Customer->getId(), $Date));			
			$CollectAll = $mCustomerCollect->findByCustomerDate(array($Customer->getId(), $Date));
																								
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Branch"	, $Branch);
			$request->setObject("Customer"	, $Customer);
			$request->setObject("TDB"		, $TDB);
			$request->setObject("TDBC"		, $TDBC);
			$request->setObject("CollectAll", $CollectAll);
			$request->setObject("InvoiceAll", $InvoiceAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>