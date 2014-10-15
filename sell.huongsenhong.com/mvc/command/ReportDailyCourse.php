<?php		
	namespace MVC\Command;	
	class ReportDailyCourse extends Command{
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
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mTC 		= new \MVC\Mapper\TrackingCourse();
			$mSD 		= new \MVC\Mapper\SessionDetail();
			$mCourse 	= new \MVC\Mapper\Course();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName	= $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			$CourseAll	= $mCourse->findAll();
			
			//Xóa dữ liệu cũ trong DB
			$mTC->deleteByTracking(array($IdTrack, $IdTD));
			
			while ($CourseAll->valid()){
				$Course = $CourseAll->current();
				$Count	= $mSD->trackByCount(array(
					$Course->getId(),
					$TD->getDate()." 0:0:0",
					$TD->getDate()." 23:59:59"
				));
				if (isset($Count)){
					$TC = new \MVC\Domain\TrackingCourse(
						null,
						$IdTrack,
						$IdTD,
						$Course->getId(),
						$Count,
						0,
						0
					);
					$mTC->insert($TC);
				}
				$CourseAll->next();
			}
			$TCAll = $mTC->findBy(array($IdTD));
			
			$Title 		= "THỐNG KÊ ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TCAll'			, $TCAll);
		}
	}
?>