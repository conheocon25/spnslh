<?php
	namespace MVC\Command;	
	class SettingSupplier extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdType = $request->getProperty('IdType');
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mSupplierType 	= new \MVC\Mapper\SupplierType();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$SupplierAll 	= $mSupplier->findByType(array($IdType));
			$SupplierType	= $mSupplierType->find($IdType);
			$SupplierTypeAll= $mSupplierType->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$SupplierAll1 = $mSupplier->findByPage(array($IdType, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($SupplierAll->count(), $Config->getValue(), "/admin/setting/supplier" );
			
			$Title = mb_strtoupper($SupplierType->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("NHÀ CUNG CẤP", "/ql-thiet-lap/nha-cung-cap")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page', 			$Page);
			$request->setObject('PN', 				$PN);
			$request->setObject('SupplierAll1', 	$SupplierAll1);
			$request->setObject('SupplierType', 	$SupplierType);
			$request->setObject('SupplierTypeAll', 	$SupplierTypeAll);
						
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>