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
			$mPaidGeneral	= new \MVC\Mapper\PaidGeneral();
			$mPaidSupplier	= new \MVC\Mapper\PaidSupplier();
			$mPaidEmployee	= new \MVC\Mapper\PaidEmployee();
			
			$mTracking 		= new \MVC\Mapper\Tracking();
			$mTD 			= new \MVC\Mapper\TrackingDaily();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName	= $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			
			//CHI CHUNG
			$PaidGeneralAll = $mPaidGeneral->findByTracking( array(
				$TD->getDate(), 
				$TD->getDate()
			));
			
			$Value1 		= 0;
			while ($PaidGeneralAll->valid()){
				$Paid 	= $PaidGeneralAll->current();
				$Value1	+= $Paid->getValue();
				$PaidGeneralAll->next();
			}			
			$NTotal1 = new \MVC\Library\Number($Value1);
									
			//CHI NHÂN VIÊN
			$PaidEmployeeAll = $mPaidEmployee->findByTracking( array(
				$TD->getDate(),
				$TD->getDate()
			));
			
			$Value3 		= 0;
			while ($PaidEmployeeAll->valid()){
				$Paid 	 = $PaidEmployeeAll->current();
				$Value3 += $Paid->getValue();
				$PaidEmployeeAll->next();
			}			
			$NTotal3 = new \MVC\Library\Number($Value3);
						
			//Cập nhật kết quả vào DB
			$NTotal = new \MVC\Library\Number( $Value1 + $Value3 );
			
			$TD->setPaid( $Value1 + $Value3 );
			$mTD->update($TD);
			
			$Title 		= "TIỀN CHI ".$TD->getDatePrint();
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
			
			$request->setObject('NTotal1'		, $NTotal1);
			$request->setObject('PaidGeneralAll', $PaidGeneralAll);
									
			$request->setObject('NTotal3'		, $NTotal3);
			$request->setObject('PaidEmployeeAll', $PaidEmployeeAll);
			
			$request->setObject('NTotal'		, $NTotal);
		}
	}
?>