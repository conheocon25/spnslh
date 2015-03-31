<?php		
	namespace MVC\Command;	
	class BranchReportTrackDailyCustomerView extends Command {
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
			
			$Date		= $TDB->getDate();
			$Customer	= $TDBC->getCustomer();
			
			//DEBT OLD
			
			//SALE
			$InvoiceAll = $mInvoiceSell->findByCustomerDate(array($Customer->getId(), $Date));
			$ValueInvoice = 0;
			while ($InvoiceAll->valid()){
				$Invoice = $InvoiceAll->current();
				$ValueInvoice += $Invoice->getValue();
				$InvoiceAll->next();
			}
			$TDBC->setSale($ValueInvoice);
									
			//COLLECT
			$CollectAll = $mCustomerCollect->findByCustomerDate(array($Customer->getId(), $Date));
			$ValueCollect = 0;
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$ValueCollect += $Collect->getValue();
				$CollectAll->next();
			}
			$TDBC->setCollect($ValueCollect);
			
			$mTrackDailyBranchCustomer->update($TDBC);
			
			$Title 		= mb_strtoupper($Customer->getName(), 'UTF8');
			$Navigation = array(
				array(mb_strtoupper($Branch->getName(), 'UTF8'), "/don-vi/".$Branch->getKey()),
				array("BÁO CÁO", "/don-vi/".$Branch->getKey()."/bao-cao"),				
				array($Track->getName(), $Branch->getURLTrackDaily( $Track )),
				array($TDB->getDatePrint(), $TDB->getURLCustomer())
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);												
			
			$request->setObject("TDBC"		, $TDBC);
			$request->setObject("CollectAll", $CollectAll);
			$request->setObject("InvoiceAll", $InvoiceAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>