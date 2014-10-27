<?php		
	namespace MVC\Command;	
	class ASettingLinked extends Command {
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
			$mLinked 	= new \MVC\Mapper\Linked();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$LinkedAll = $mLinked->findAll();
						
			$Title = "LIÊN KẾT";
			$Navigation = array(array("THIẾT LẬP", "/admin/setting"));
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$LinkedAll1 = $mLinked->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($LinkedAll->count(), $Config->getValue(), "/setting/linked" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Linked');
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('LinkedAll1'	, $LinkedAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>