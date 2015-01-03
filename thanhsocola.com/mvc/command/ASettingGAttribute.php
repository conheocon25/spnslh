<?php		
	namespace MVC\Command;	
	class ASettingGAttribute extends Command {
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
			$mGAttribute 	= new \MVC\Mapper\GAttribute();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$GAttributeAll = $mGAttribute->findAll();			
						
			$Title = "DANH MỤC MÔ TẢ";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			$GAttributeAll1 = $mGAttribute->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($GAttributeAll->count(), $Config->getValue(), "/setting/gattribute" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'GAttribute');
			$request->setProperty('Page'			, $Page);			
			$request->setObject('PN'				, $PN);
			$request->setObject('Navigation'		, $Navigation);
			$request->setObject('GAttributeAll1'	, $GAttributeAll1);
			$request->setObject('ConfigName'		, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>