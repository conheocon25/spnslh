<?php
	namespace MVC\Command;	
	class ReportDailyExport extends Command{
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
			$mOrder		= new \MVC\Mapper\OrderExport();
			$mSupplier	= new \MVC\Mapper\Supplier();
			$mConfig 	= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			$SupplierAll= $mSupplier->findAll();
			
			$OrderAll 	= $mOrder->findByTracking(array($TD->getDate(), $TD->getDate()));
			$Title = $TD->getDatePrint();
			$Value = 0;
			while($OrderAll->valid()){
				$Order = $OrderAll->current();
				$Value += $Order->getValue();
				$OrderAll->next();
			}
			$TD->setExport($Value);
			$mTD->update($TD);
			
			$Navigation = array(				
				array("BÁO CÁO", "/report"),
				array($Tracking->getName(), $Tracking->getURLView() )
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);											
			$request->setObject('TD'			, $TD);
						
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>