<?php		
	namespace MVC\Command;	
	class ReportDetailCustomerDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack 	= $request->getProperty("IdTrack");
			$IdTC 		= $request->getProperty("IdTC");
			$Action 	= $request->getProperty("action");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking	= new \MVC\Mapper\Tracking();
			$mTC 		= new \MVC\Mapper\TrackingCustomer();
			$mCC 		= new \MVC\Mapper\CollectCustomer();
			$mSession 	= new \MVC\Mapper\Session();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Tracking			= $mTracking->find($IdTrack);						
			$TC 				= $mTC->find($IdTC);
			$TCPre				= $mTC->findByPre(array($IdTrack, $TC->getIdCustomer()));
			if ($TCPre->count()>0){
				$ValueOld = $TCPre->current()->getValue();
			}else{
				$ValueOld = 0;
			}
						
			$SessionAll 		= $mSession->findByTrackingFullCustomer(array($TC->getIdCustomer(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
			$CollectAll 		= $mCC->findByTrackingCustomer(array($TC->getIdCustomer(), $Tracking->getDateStart(), $Tracking->getDateEnd()));
			
			$CollectValue 	= 0;
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$CollectValue += $Collect->getValue();
				$CollectAll->next();
			}
			$TC->setCollect($CollectValue);
			
			$PaidValue 		= 0;
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();
				$PaidValue += $Session->getValue();
				$SessionAll->next();
			}
			$TC->setPaid($PaidValue);
			
			$Value = $ValueOld + $PaidValue - $CollectValue;
			$TC->setValue($Value);
			$mTC->update($TC);
						
			$NValueOld = number_format($ValueOld, 0, ',', '.');
			
			$ConfigName 		= $mConfig->findByName("NAME");					
			$Title 				= mb_strtoupper($TC->getCustomer()->getName(), 'UTF8');
			$Navigation = array(
				array("BÁO CÁO", "/report"),
				array($Tracking->getName(). "/ KHÁCH HÀNG", $Tracking->getURLCustomer())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			
			$request->setProperty('ValueOld'	, $NValueOld);
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('TC'			, $TC);
			
			$request->setObject('SessionAll'	, $SessionAll);							
			$request->setObject('CollectAll'	, $CollectAll);			
			
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>