<?php
	namespace MVC\Command;	
	class Search extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCustomer = new \MVC\Mapper\Customer();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------					
			$Title = "TÌM KIẾM";
			$Navigation = array();
			
			$CustomerAll = $mCustomer->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			
			$request->setProperty("Title", $Title);
			$request->setProperty("ActiveAdmin", 'Admin');
			$request->setObject("Navigation", $Navigation);
			
			$request->setObject("CustomerAll", $CustomerAll);
		}
	}
?>