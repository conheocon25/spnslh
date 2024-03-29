<?php		
	namespace MVC\Command;	
	class BranchReportTrackDailyCustomer extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 			= new \MVC\Mapper\Config();
			$mBranch 			= new \MVC\Mapper\Branch();
			$mTrack 			= new \MVC\Mapper\Track();
			$mTrackDailyBranch 	= new \MVC\Mapper\TrackDailyBranch();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Branch		= $mBranch->findByKey($IdKey);
			$Track 		= $mTrack->find($IdTrack);
			$TDB		= $mTrackDailyBranch->find($IdTDB);
			$TDBAll 	= $mTrackDailyBranch->findByTrackBranch(array($Track->getId(), $Branch->getId()));
			
			if ($TDB->getTDBCustomerAll()->count()==0){
				$TDB->generate();
			}
			
			//-------------------------------------------------------------
			//Cập nhật báo cáo
			//-------------------------------------------------------------
			$SDebtOld 	= 0;
			$SSale 		= 0;
			$SCollect	= 0;
			
			$TDBCAll = $TDB->getTDBCustomerAll();			
			while ($TDBCAll->valid()){
				$TDBC = $TDBCAll->current();
				$SDebtOld 	+= $TDBC->getDebtOld();
				$SSale 		+= $TDBC->getSale();
				$SCollect	+= $TDBC->getCollect();
				$TDBCAll->next();
			}
			$TDB->setDebtOld($SDebtOld);
			$TDB->setSale($SSale);
			$TDB->setCollect($SCollect);
			$mTrackDailyBranch->update($TDB);
									
			$Title 		= $TDB->getDatePrint();
			$Navigation = array(
				array(mb_strtoupper($Branch->getName(), 'UTF8'), "/don-vi/".$Branch->getKey()),
				array("BÁO CÁO", "/don-vi/".$Branch->getKey()."/bao-cao"),				
				array($Track->getName(), $Branch->getURLTrackDaily( $Track ))
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);									
			$request->setObject("TDB"		, $TDB);
			$request->setObject("TDBAll"	, $TDBAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>