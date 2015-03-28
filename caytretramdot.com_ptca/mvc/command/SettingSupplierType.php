<?php		
	namespace MVC\Command;	
	class SettingSupplierType extends Command {
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
			$mSupplierType 	= new \MVC\Mapper\SupplierType();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$SupplierTypeAll = $mSupplierType->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$SupplierTypeAll1 = $mSupplierType->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($SupplierTypeAll->count(), $Config->getValue(), "/admin/setting/SupplierType" );
			
			$Title = "NHÀ CUNG CẤP";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page', 				$Page);
			$request->setObject('PN', 					$PN);
			$request->setObject('SupplierTypeAll1', 	$SupplierTypeAll1);
			
			$request->setProperty('Title'				, $Title);
			$request->setObject('Navigation'			, $Navigation);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>