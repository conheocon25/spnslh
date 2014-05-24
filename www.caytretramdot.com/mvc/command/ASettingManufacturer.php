<?php		
	namespace MVC\Command;	
	class ASettingManufacturer extends Command {
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
			$mManufacturer 	= new \MVC\Mapper\Manufacturer();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ManufacturerAll = $mManufacturer->findAll();			
						
			$Title = "NHÀ SẢN XUẤT";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			$ManufacturerAll1 = $mManufacturer->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($ManufacturerAll->count(), $Config->getValue(), "/admin/setting/manufacturer" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'Manufacturer');
			$request->setProperty('Page'			, $Page);			
			$request->setObject('PN'				, $PN);
			$request->setObject('Navigation'		, $Navigation);
			$request->setObject('ManufacturerAll1'	, $ManufacturerAll1);
			$request->setObject('ConfigName'		, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>