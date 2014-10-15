<?php		
	namespace MVC\Command;	
	class ReportChartSelling extends Command{
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
			$IdCourse 	= $request->getProperty('IdCourse');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------									
			$mTracking 	= new \MVC\Mapper\Tracking();			
			$mTD 		= new \MVC\Mapper\TrackingDaily();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$TDAll 	= $mTD->findBy(array($IdTrack));
			$Data = array();
			while ($TDAll->valid()){
				$TD = $TDAll->current();
				$Data[] = array( $TD->getDateShortPrint(), $TD->getSelling() );
				$TDAll->next();
			}
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$json = array(
				'result' 	=> "OK",
				'data'		=> $Data
			);
			echo json_encode($json);
		}
	}
?>