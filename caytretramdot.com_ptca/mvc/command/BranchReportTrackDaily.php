<?php		
	namespace MVC\Command;	
	class BranchReportTrackDaily extends Command {
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
			
			$TDBAll = $mTrackDailyBranch->findByTrackBranch(array($Track->getId(), $Branch->getId()));
			if ($TDBAll->count()==0){
				$Track->generateDailyBranch($Branch);
				$TDBAll = $mTrackDailyBranch->findByTrackBranch(array($Track->getId(), $Branch->getId()));
			}
			
			$Title 		= $Track->getName();
			$Navigation = array(
				array(mb_strtoupper($Branch->getName(), 'UTF8'), "/don-vi/".$Branch->getKey()),
				array("BÁO CÁO", "/don-vi/".$Branch->getKey()."/bao-cao")
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);
						
			$request->setObject("Track"		, $Track);
			$request->setObject("TDBAll"	, $TDBAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>