<?php		
	namespace MVC\Command;	
	class ReportDailyCustomer extends Command{
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
			$mCustomer	= new \MVC\Mapper\Customer();
			$mConfig	= new \MVC\Mapper\Config();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TD 			= $mTD->find($IdTD);
			$Tracking		= $mTracking->find($IdTrack);
			$CustomerAll	= $mCustomer->findByNormal(array());
			$ConfigName		= $mConfig->findByName("NAME");
			
			//CẬP NHẬT SỐ TIỀN KHÁCH HÀNG NỢ / TRẢ ĐẾN THỜI ĐIỂM HIỆN TẠI
			$Value = 0;
			while($CustomerAll->valid()){
				$Customer = $CustomerAll->current();
				$Value +=$Customer->getValue( $IdTrack, $IdTD );
				$CustomerAll->next();
			}
			$NValue = new \MVC\Library\Number($Value);
						
			$Title 			= "KHÁCH HÀNG ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setProperty('IdTrack'		, $IdTrack);
			$request->setProperty('IdTD'		, $IdTD);
			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('CustomerAll'	, $CustomerAll);
								
			$request->setObject('TD'			, $TD);
			$request->setObject('NValue'		, $NValue);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>