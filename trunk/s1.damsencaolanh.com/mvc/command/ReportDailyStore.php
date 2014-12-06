<?php		
	namespace MVC\Command;	
	class ReportDailyStore extends Command{
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
			$mTS 		= new \MVC\Mapper\TrackingStore();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mSD 		= new \MVC\Mapper\SessionDetail();
			$mOD 		= new \MVC\Mapper\OrderImportDetail();
			$mR2C  		= new \MVC\Mapper\R2C();
			$mResource 	= new \MVC\Mapper\Resource();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$ConfigName		= $mConfig->findByName("NAME");
			$Tracking 		= $mTracking->find($IdTrack);
			$TD				= $mTD->find($IdTD);
			$R2CAll			= $mR2C->findAll();
			$ResourceAll 	= $mResource->findAll();
			
			//Xóa những dữ liệu tồn kho cũ
			$mTS->deleteByTracking(array($IdTD));
			
			while ($R2CAll->valid()){
				$R2C = $R2CAll->current();
																													
				//Tính số lượng hàng nhập trong kì				
				$CountImport 	= $mOD->trackByCount(array($R2C->getIdResource(), $TD->getDate(), $TD->getDate()));
				$CountExport 	= $mOD->trackByExport(array($R2C->getIdResource(), $TD->getDate(), $TD->getDate()));
									
				$TS = new \MVC\Domain\TrackingStore(
					null,					
					$IdTD,
					$R2C->getIdResource(), 					
					$CountImport, 
					$CountExport,
					$R2C->getResource()->getPrice()
				);
				$mTS->insert($TS);
				$R2CAll->next();
			}						
			$TSAll = $mTS->findByDaily(array($IdTD));
									
			$Title = "TỒN KHO ".$TD->getDatePrint();
			$Navigation = array(				
				array("BÁO CÁO", "/report"),
				array($Tracking->getName(), $Tracking->getURLView() )
			);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('TSAll'			, $TSAll);			
		}
	}
?>