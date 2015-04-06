<?php		
	namespace MVC\Command;	
	class ReportTrackWarehouse extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mTrack 	= new \MVC\Mapper\Track();
			$mTDW 		= new \MVC\Mapper\TrackDailyWarehouse();
														
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Track 			= $mTrack->find($IdTrack);
			$TDWAll			= $mTDW->findByDate(array($Date));
			
			$SOld 		= 0;
			$SImport 	= 0;
			$SExport 	= 0;
			$SNew 		= 0;
			
			while ($TDWAll->valid()){
				$TDW 	= $TDWAll->current();
				$SOld 	+= $TDW->getOld();
				$SImport+= $TDW->getImport();
				$SExport+= $TDW->getExport();
				$SNew 	+= $TDW->getNew();
				
				$TDWAll->next();			
			}
			$SOldStr 	= number_format($SOld, 0, ',', ' ');
			$SImportStr = number_format($SImport, 0, ',', ' ');
			$SExportStr = number_format($SExport, 0, ',', ' ');
			$SNewStr 	= number_format($SNew, 0, ',', ' ');
			$DateStr		= date('d/m/Y', strtotime($Date));
			
			$Title 			= $DateStr.' KHO HÀNG';
			$Navigation 	= array(
				array("BÁO CÁO", 		"/ql-bao-cao"),
				array($Track->getName(), $Track->getURLReport())
			);
																							
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
			
			$request->setProperty("SOldStr", 	$SOldStr);
			$request->setProperty("SImportStr", $SImportStr);
			$request->setProperty("SExportStr", $SExportStr);
			$request->setProperty("SNewStr", 	$SNewStr);
									
			$request->setObject("Track", 		$Track);
			$request->setObject("TDWAll", 		$TDWAll);
																		
			return self::statuses('CMD_DEFAULT');	
		}
	}
?>