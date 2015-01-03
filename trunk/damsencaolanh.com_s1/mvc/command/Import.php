<?php		
	namespace MVC\Command;	
	class Import extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$SupplierAll = $mSupplier->findAll();			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title 		= "NHẬP HÀNG";
			$Navigation = array();
			$ConfigName	= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Import');
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('SupplierAll'	, $SupplierAll);			
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>