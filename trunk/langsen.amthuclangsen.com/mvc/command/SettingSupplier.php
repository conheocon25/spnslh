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
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$SupplierAll = $mSupplier->findAll();
						
			$Title = "NHÀ CUNG CẤP";
			$Navigation = array(				
				array("THIẾT LẬP", "/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$SupplierAll1 = $mSupplier->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($SupplierAll->count(), $Config->getValue(), "/setting/supplier" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'Supplier');
			$request->setProperty('Page', 			$Page);
			$request->setObject('PN', 				$PN);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('SupplierAll1', 	$SupplierAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>