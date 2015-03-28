<?php
	namespace MVC\Command;	
	class SearchExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$SearchCustomer = $request->getProperty('SearchCustomer');
			$DateStart		= $request->getProperty('DateStart');
			$DateEnd		= $request->getProperty('DateEnd');
			$ValueFrom		= $request->getProperty('ValueFrom');
			$ValueTo		= $request->getProperty('ValueTo');
												
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSession  			= new \MVC\Mapper\Session();
			$mCollectCustomer  	= new \MVC\Mapper\CollectCustomer();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------					
			$SessionAll = $mSession->searchBy($SearchCustomer, $DateStart, $DateEnd, 0, 0);
			$CollectAll = $mCollectCustomer->searchBy($SearchCustomer, $DateStart, $DateEnd, 0, 0);
			
			$SessionValue = 0;
			$SessionCount = 0;
			$CollectValue = 0;
			
			while ($SessionAll->valid()){
				$Session = $SessionAll->current();
				$SessionValue += $Session->getValue();
				$SessionCount += $Session->getCount();
				$SessionAll->next();
			}
						
			while ($CollectAll->valid()){
				$Collect = $CollectAll->current();
				$CollectValue += $Collect->getValue();				
				$CollectAll->next();
			}
			
			$NSessionValue = \number_format($SessionValue, 0, ',', ' ');
			$NCollectValue = \number_format($CollectValue, 0, ',', ' ');
			$NSessionCount = \number_format($SessionCount, 1, ',', ' ');
									
			$Title 	= "KẾT QUẢ";
			$Navigation = array(array("TÌM KIẾM", "/search"));
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveAdmin", 'Admin');
			$request->setObject("Navigation", $Navigation);
			
			$request->setObject("SessionAll", $SessionAll);
			$request->setObject("CollectAll", $CollectAll);
			
			$request->setObject("NSessionValue", $NSessionValue);
			$request->setObject("NSessionCount", $NSessionCount);
			$request->setObject("NCollectValue", $NCollectValue);
		}
	}
?>