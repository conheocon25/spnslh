<?php		
	namespace MVC\Command;	
	class ASettingTag extends Command {
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
			$mTag 		= new \MVC\Mapper\Tag();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$TagAll 	= $mTag->findAll();
						
			$Title 		= "THẺ BÀI";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			$TagAll1 = $mTag->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($TagAll->count(), $Config->getValue(), "/setting/Tag" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Tag');
			$request->setProperty('Page'		, $Page);			
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TagAll1'		, $TagAll1);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>