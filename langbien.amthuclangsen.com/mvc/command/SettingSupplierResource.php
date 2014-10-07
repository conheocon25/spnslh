<?php		
	namespace MVC\Command;	
	class SettingSupplierResource extends Command {
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
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$UnitAll = $mUnit->findAll();						
			$SupplierAll = $mSupplier->findAll();
						
			$Supplier = $mSupplier->find($IdSupplier);			
			$Title = mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/setting"),
				array("NHÀ CUNG CẤP", "/setting/supplier")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
			
			$ResourceAll1 = $mResource->findByPage(array($IdSupplier, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Supplier->getResourceAll()->count(), $Config->getValue(), $Supplier->getURLResource() );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Resource');
			$request->setProperty('Page'		, $Page);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ResourceAll1'	, $ResourceAll1);
			$request->setObject('Supplier'		, $Supplier);
			$request->setObject('PN'			, $PN);
			$request->setObject('ConfigName'	, $ConfigName);
						
			$request->setObject('UnitAll'		, $UnitAll);									
			$request->setObject('SupplierAll'	, $SupplierAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>