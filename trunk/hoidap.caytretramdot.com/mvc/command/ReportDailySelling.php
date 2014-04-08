<?php		
	namespace MVC\Command;	
	class ReportDailySelling extends Command {
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
			$mDomain 	= new \MVC\Mapper\Domain();
			$mSession 	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$SessionAll  = null;
			$SessionAll1 = null;
			$SessionAll2 = null;
			
			$ConfigName = $mConfig->findByName("NAME");
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			$DomainAll	= $mDomain->findAll();
			
			$Time1 = $TD->getTime1();
			
			//NẾU KẾT THÚC 2 CA
			if ($TD->isOne()==false){
				//TỔNG KẾT CA1 00:00 ĐẾN TRƯỚC TIME1
				$SessionAll1 = $mSession->findByTracking( array(
					$TD->getDate()." 0:0:0",
					$Time1
				));			
				$Value11 		= 0;
				$Value12 		= 0;
				while ($SessionAll1->valid()){
					$Session = $SessionAll1->current();
					if ($Session->getStatus()==2)
						$Value12 += $Session->getValue();
					else	
						$Value11 += $Session->getValue();						
					$SessionAll1->next();
				}
				
				//TỔNG KẾT CA2 TIME1 ĐẾN TRƯỚC 23:59:59
				$SessionAll2 = $mSession->findByTracking( array(
					$Time1,
					$TD->getDate()." 23:59:59",
				));			
				$Value21 		= 0;
				$Value22 		= 0;
				while ($SessionAll2->valid()){
					$Session = $SessionAll2->current();
					if ($Session->getStatus()==2)
						$Value22 += $Session->getValue();
					else	
						$Value21 += $Session->getValue();						
					$SessionAll2->next();
				}
				$Value1 	= $Value11 + $Value12;
				$Value2 	= $Value21 + $Value22;
				
				$NTotal 	= new \MVC\Library\Number($Value1 + $Value2);
				$NTotal1 	= new \MVC\Library\Number($Value1); 
				$NTotal11 	= new \MVC\Library\Number($Value11); 
				$NTotal12 	= new \MVC\Library\Number($Value12); 				
				$NTotal2 	= new \MVC\Library\Number($Value2);
				$NTotal21 	= new \MVC\Library\Number($Value21); 
				$NTotal22 	= new \MVC\Library\Number($Value22);
				
			}else{
				//TỔNG KẾT CA1 00:00 ĐẾN TRƯỚC 23:59
				$SessionAll = $mSession->findByTracking( array(
					$TD->getDate()." 0:0:0",
					$TD->getDate()." 23:59:59"
				));			
				$Value1 		= 0;
				$Value2 		= 0;
				while ($SessionAll->valid()){
					$Session = $SessionAll->current();
					if ($Session->getStatus()==2)
						$Value2 += $Session->getValue();
					else	
						$Value1 += $Session->getValue();
						
					$SessionAll->next();
				}
				//TỔNG CỘNG
				$NTotal 	= new \MVC\Library\Number($Value1 + $Value2);
				$NTotal1 	= new \MVC\Library\Number($Value1); 
				$NTotal2 	= new \MVC\Library\Number($Value2);
			}
																					
			$Title 		= "BÁN HÀNG ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('SessionAll1'	, $SessionAll1);
			$request->setObject('SessionAll2'	, $SessionAll2);
			
			$request->setObject('SessionAll'	, $SessionAll);
			
			$request->setObject('NTotal'		, $NTotal);
			$request->setObject('NTotal1'		, $NTotal1);
			$request->setObject('NTotal11'		, isset($NTotal11)==false?null:$NTotal11);
			$request->setObject('NTotal12'		, isset($NTotal12)==false?null:$NTotal12);
			$request->setObject('NTotal2'		, $NTotal2);
			$request->setObject('NTotal21'		, isset($NTotal21)==false?null:$NTotal21);
			$request->setObject('NTotal22'		, isset($NTotal22)==false?null:$NTotal22);
			
			$request->setObject('TD'			, $TD);
			$request->setObject('DomainAll'		, $DomainAll);
			
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>