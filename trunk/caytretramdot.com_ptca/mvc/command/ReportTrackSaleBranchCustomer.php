<?php		
	namespace MVC\Command;	
	class ReportTrackSaleBranchCustomer extends Command {
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
			$Date 		= $request->getProperty('Date');
			$IdTDB 		= $request->getProperty('IdTDB');
			$IdTDBC 	= $request->getProperty('IdTDBC');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 			= new \MVC\Mapper\Config();
			$mTrack 			= new \MVC\Mapper\Track();
			$mTDB 				= new \MVC\Mapper\TrackDailyBranch();
			$mTDBC 				= new \MVC\Mapper\TrackDailyBranchCustomer();
			$mInvoiceSell 		= new \MVC\Mapper\InvoiceSell();
			$mCustomerCollect 	= new \MVC\Mapper\CustomerCollect();
											
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Track 			= $mTrack->find($IdTrack);
			$TDB			= $mTDB->find($IdTDB);
			$TDBC			= $mTDBC->find($IdTDBC);
			$Customer		= $TDBC->getCustomer();
			
			//DEBT OLD
			$TDBCPre 	= $mTDBC->findPre(array($IdTDBC, $Customer->getId()));
			if (isset($TDBCPre)){
				$DebtOldValue = $TDBCPre->getDebtNew();				
			}else{
				$DebtOldValue = $Customer->getInit()->getDebt();
			}
						
			//SALE
			$InvoiceAll = $mInvoiceSell->findByCustomerDateState(array($Customer->getId(), $Date, 2));
			$ValueInvoice = 0;
			while ($InvoiceAll->valid()){
				$Invoice = $InvoiceAll->current();
				$ValueInvoice += $Invoice->getValue();
				$InvoiceAll->next();
			}
												
			//COLLECT
			$CollectAll = $mCustomerCollect->findByCustomerDate(array($Customer->getId(), $Date));
			$ValueCollect = 0;
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$ValueCollect += $Collect->getValue();
				$CollectAll->next();
			}
			$TDBC->setCollect($ValueCollect);

			
			$Title 			= mb_strtoupper($TDBC->getCustomer()->getName(), 'UTF8');
			$Navigation 	= array(								
				array("BÁO CÁO", 						"/ql-bao-cao"),
				array($Track->getName(), 				$Track->getURLReport()),
				array($TDB->getDatePrint()." BÁN HÀNG", "/ql-bao-cao/".$Track->getId()."/".$TDB->getDate()."/ban-hang"),
				array($TDB->getBranch()->getName(), 	$TDB->getURLReport())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
						
			$request->setObject("Track", 		$Track);
			$request->setObject("TDB", 			$TDB);
			$request->setObject("TDBC", 		$TDBC);
			$request->setObject("CollectAll", 	$CollectAll);
			$request->setObject("InvoiceAll", 	$InvoiceAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>