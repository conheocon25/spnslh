<?php
	namespace MVC\Command;	
	class CheckingDomainTable extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdDomain 	= $request->getProperty("IdDomain");
			$IdTable 	= $request->getProperty("IdTable");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mConfig 	= new \MVC\Mapper\Config();
			$mSession 	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Domain 	= $mDomain->find($IdDomain);
			$Table 		= $mTable->find($IdTable);
			$TableAll	= $mTable->findAll();
			$TrackingAll= $mTracking->findAll();
			$Tracking	= $TrackingAll->last();
			$SessionAll = $mSession->findByTrackingTable(array($Tracking->getId(), $Table->getId()));
			/*
			if ($SessionAll->count()<1){
				//Phát sinh dữ liệu mẫu
				$StudentAll = $Table->getStudentAll();
				while($StudentAll->valid()){
					$Student = $StudentAll->current();
					$Session = new \MVC\Domain\Session(
						null,
						$Tracking->getId(),
						$Student->getId(),
						0
					);
					$mSession->insert($Session);				
					$StudentAll->next();
				}
				$SessionAll = $mSession->findByTrackingTable(array($Tracking->getId(), $Table->getId()));
			}*/
						
			$Title = mb_strtoupper($Table->getName(), 'UTF8');
			$Navigation = array(				
				array("ĐÓNG PHÍ", "/checking"),
				array($Domain->getName(), $Domain->getURLChecking() ),
			);						
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Domain"	, $Domain);
			$request->setObject("Table"		, $Table);
			$request->setObject("TableAll"	, $TableAll);
			$request->setObject("SessionAll", $SessionAll);
			$request->setObject("ConfigName", $ConfigName);
			
			$request->setProperty("Title"	, $Title);			
			$request->setObject("Navigation", $Navigation);			
		}
	}
?>