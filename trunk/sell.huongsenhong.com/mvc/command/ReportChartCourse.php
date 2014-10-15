<?php		
	namespace MVC\Command;	
	class ReportChartCourse extends Command{
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
			$mTC 		= new \MVC\Mapper\TrackingCourse();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			//$Tracking 	= $mTracking->find($IdTrack);
			$TCAll 		= $mTC->findByCourse(array($IdTrack, $IdCourse));			
			$Data = array();
			while ($TCAll->valid()){
				$TC = $TCAll->current();
				$Data[] = array( $TC->getTD()->getDateShortPrint(), $TC->getCountPrint() );
				$TCAll->next();
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