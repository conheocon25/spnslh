<?php		
	namespace MVC\Command;	
	class ReportDetailCustomer extends Command{
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
			$mSession	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTC		= new \MVC\Mapper\TrackingCustomer();
			$mCC		= new \MVC\Mapper\CollectCustomer();
			$mCustomer	= new \MVC\Mapper\Customer();
			$mConfig	= new \MVC\Mapper\Config();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Tracking		= $mTracking->find($IdTrack);			
			$ConfigName		= $mConfig->findByName("NAME");
			
			$SValue = 0;
			//XÓA PHÁT SINH TÍNH CÔNG NỢ			
			$mTC->deleteByTracking(array($IdTrack));
						
			//PHÁT SINH TÍNH CÔNG NỢ
			$CustomerAll 	= $mCustomer->findAll();
			while ($CustomerAll->valid()){
				$Customer = $CustomerAll->current();
				
				//TÍNH NỢ CŨ CỦA KHÁCH HÀNG
				$TCAll = $mTC->findByPre( array($IdTrack, $Customer->getId()) );
				if ($TCAll->count()==0){$ValueOld = 0;}
				else{$ValueOld = $TCAll->current()->getValue();}
						
				//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
				$D1 		= $Tracking->getDateStart()." 1:0:0";
				$D2 		= $Tracking->getDateEnd()." 23:59:59";
				$SessionAll = $mSession->findByTrackingCustomer(array($Customer->getId(), $D1, $D2));
				$VS1	=	0;
				$VS2	=	0;
				while ($SessionAll->valid()){
					$Session = $SessionAll->current();
					if ($Session->getStatus()==1)
						$VS1 += $Session->getValue();
					else if ($Session->getStatus()==2)
						$VS2 += $Session->getValue();
					$SessionAll->next();
				}
						
				//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
				$CollectAll = $mCC->findByTracking(array($Customer->getId(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
				$VC = 0;
				while ($CollectAll->valid()){
					$Collect = $CollectAll->current();
					$VC += $Collect->getValue();
					$CollectAll->next();
				}
													
				$TC = new \MVC\Domain\TrackingCustomer(
					null,
					$IdTrack,
					$Customer->getId(),
					$VS1,
					$VS2,
					$VC,
					$ValueOld
				);
				$mTC->insert($TC);							
				$SValue += $TC->getValue();
				$CustomerAll->next();
				
			}						
			$TCAll 		= $mTC->findByTracking(array($IdTrack));
			
			$NSValue	= new \MVC\Library\Number($SValue);
			
			$Title 		= "CÔNG NỢ KHÁCH HÀNG";
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setProperty('SValue'		, $NSValue);
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('TCAll'			, $TCAll);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>