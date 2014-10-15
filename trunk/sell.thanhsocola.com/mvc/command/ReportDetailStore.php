<?php		
	namespace MVC\Command;	
	class ReportDetailStore extends Command{
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
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTS 		= new \MVC\Mapper\TrackingStore();			
			$mResource 	= new \MVC\Mapper\Resource();
			$mOID 		= new \MVC\Mapper\OrderImportDetail();
			$mOED 		= new \MVC\Mapper\OrderExportDetail();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$ConfigName		= $mConfig->findByName("NAME");
			$Tracking 		= $mTracking->find($IdTrack);
						
			$ResourceAll 	= $mResource->findAll();			
			
			//Xóa những dữ liệu tồn kho cũ
			$mTS->deleteByTracking(array($IdTrack));
			
			$Sum = 0;			
			while ($ResourceAll->valid())
			{
				$Resource = $ResourceAll->current();
				
				$TS1 	 = $mTS->findByPre( array( $IdTrack, $Resource->getId()) );
				if ($TS1->count() <= 0) $CountOld=0;
				else $CountOld = $TS1->current()->getCountRemain();
				
				$CountImport = $mOID->trackByCount( array($Resource->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd() ));
				$CountExport = $mOED->trackByCount( array($Resource->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd() ));
				
				$TS = new \MVC\Domain\TrackingStore(
					null,
					$IdTrack,				
					$Resource->getId(),
					$CountOld,
					$CountImport,
					$CountExport,
					$Resource->getPrice()
				);
				$mTS->insert($TS);
				$Sum += $TS->getCountRemainValue();
				
				$ResourceAll->next();
			}			
			$TSAll = $mTS->findBy(array($IdTrack));
			
			$NSum = new \MVC\Library\Number($Sum);			
			$Title = "TỒN KHO ".$Tracking->getName();
			$Navigation = array(				
				array("BÁO CÁO", "/report")				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			
			$request->setProperty('Sum'			, $NSum);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Tracking'		, $Tracking);			
			$request->setObject('ResourceAll'	, $ResourceAll);
			$request->setObject('TSAll'			, $TSAll);
		}
	}
?>