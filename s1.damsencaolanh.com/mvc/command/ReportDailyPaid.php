<?php		
	namespace MVC\Command;	
	class ReportDailyPaid extends Command {
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
			$mPaidGeneral= new \MVC\Mapper\PaidGeneral();
			$mPaidSupplier= new \MVC\Mapper\PaidSupplier();
			$mPaidCustomer= new \MVC\Mapper\PaidCustomer();
			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName			= $mConfig->findByName("NAME");
			$TD 				= $mTD->find($IdTD);
			$Tracking			= $mTracking->find($IdTrack);
			
			$PaidGeneralAll 	= $mPaidGeneral->findByTracking( array($TD->getDate(), $TD->getDate()));
			$GeneralValue 		= 0;
			while ($PaidGeneralAll->valid()){
				$Paid 			= $PaidGeneralAll->current();
				$GeneralValue 	+= $Paid->getValue();
				$PaidGeneralAll->next();
			}			
			$NGeneralValue = new \MVC\Library\Number($GeneralValue);
			
			$PaidCustomerAll 	= $mPaidCustomer->findByTracking1( array($TD->getDate(), $TD->getDate()));
			$CustomerValue 		= 0;
			while ($PaidCustomerAll->valid()){
				$Paid 			= $PaidCustomerAll->current();
				$CustomerValue 	+= $Paid->getValue();
				$PaidCustomerAll->next();
			}			
			$NCustomerValue = new \MVC\Library\Number($CustomerValue);
			
			$PaidSupplierAll 	= $mPaidSupplier->findByTracking( array($TD->getDate(), $TD->getDate()));
			$SupplierValue 		= 0;
			while ($PaidSupplierAll->valid()){
				$Paid 			= $PaidSupplierAll->current();
				$SupplierValue 	+= $Paid->getValue();
				$PaidSupplierAll->next();
			}			
			$NSupplierValue = new \MVC\Library\Number($SupplierValue);
			
			//Cập nhật kết quả vào DB
			$TD->setPaid($GeneralValue + $SupplierValue + $CustomerValue);
			$mTD->update($TD);
			
			$Title 		= "TIỀN CHI ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'			, $Title);			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('TD'				, $TD);
			
			$request->setObject('NGeneralValue'		, $NGeneralValue);
			$request->setObject('PaidGeneralAll'	, $PaidGeneralAll);			
			$request->setObject('NCustomerValue'	, $NCustomerValue);
			$request->setObject('PaidCustomerAll'	, $PaidCustomerAll);			
			$request->setObject('NSupplierValue'	, $NSupplierValue);
			$request->setObject('PaidSupplierAll'	, $PaidSupplierAll);
		}
	}
?>