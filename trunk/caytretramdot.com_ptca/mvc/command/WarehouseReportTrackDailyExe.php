<?php		
	namespace MVC\Command;	
	class WarehouseReportTrackDailyExe extends Command {
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
			$IdTDW 		= $request->getProperty('IdTDW');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 				= new \MVC\Mapper\Config();
			$mWarehouse 			= new \MVC\Mapper\Warehouse();
			$mTrack 				= new \MVC\Mapper\Track();
			$mTrackDailyWarehouse 	= new \MVC\Mapper\TrackDailyWarehouse();
			$mTDWG 					= new \MVC\Mapper\TrackDailyWarehouseGood();
			$mGood					= new \MVC\Mapper\Good();
			$mInvoiceImportDetail	= new \MVC\Mapper\InvoiceImportDetail();
			$mInvoiceSellDetail		= new \MVC\Mapper\InvoiceSellDetail();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Warehouse			= $mWarehouse->findByKey($IdKey);
			$Track 				= $mTrack->find($IdTrack);
			$TDW 				= $mTrackDailyWarehouse->find($IdTDW);			
			$InvoiceSell 		= $mTrackDailyWarehouse->find($IdTDW);
			$GoodAll			= $mGood->findAll();
									
			//Tính toán lại giá trị
			$TDWGAll = $TDW->getGoodAll();
			$SOld 		= 0;
			$SImport 	= 0;
			$SExport 	= 0;
			
			while ($TDWGAll->valid()){
				$TDWG = $TDWGAll->current();
				
				//Tính hàng tồn
				$TDWGPre = $mTDWG->findPre(array($TDWG->getId(), $TDWG->getIdGood()));
				if (isset($TDWGPre)){
					$Old = $TDWGPre->getNew();				
				}else{				
					$Init = $Warehouse->getInitGood($TDWG->getIdGood());
					if (!isset($Init)){
						$Old = 0;
					}else{
						$Old = $Init->getValue();
					}
				}
				$TDWG->setOld($Old);
				$SOld += $Old;
											
				//Tính lại hàng nhập về
				$Import = 0;
				$IIDAll = $mInvoiceImportDetail->findByDateGood(array($TDW->getDate(), $TDWG->getIdGood()));								
				while ($IIDAll->valid()){
					$IID = $IIDAll->current();
					$Import += $IID->getCount();
					$IIDAll->next();
				}
				$TDWG->setImport($Import);
				$SImport += $Import;
				
				//Tính lại hàng xuất bàn
				$Export = 0;
				$ISDAll = $mInvoiceSellDetail->findByDateGood(array($TDW->getDate(), $TDWG->getIdGood()));
				while ($ISDAll->valid()){
					$ISD = $ISDAll->current();
					$Export += $ISD->getCount();
					$ISDAll->next();
				}
				$TDWG->setExport($Export);
				$SExport += $Export;
				
				$mTDWG->update($TDWG);
				$TDWGAll->next();
			}
			$TDW->setOld($SOld);
			$TDW->setImport($SImport);
			$TDW->setExport($SExport);
			$mTrackDailyWarehouse->update($TDW);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_DEFAULT');
		}
	}
?>