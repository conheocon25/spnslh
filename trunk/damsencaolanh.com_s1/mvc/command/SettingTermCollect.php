<?php		
	namespace MVC\Command;	
	class SettingTermCollect extends Command {
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
			$TermCollectAll = $mTermCollect->findAll();			
						
			$Title = "DANH MỤC THU";
			$Navigation = array(			
				array("THIẾT LẬP", "/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 			= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName			= $mConfig->findByName("NAME");
			
			$TermCollectAll1 	= $mTermCollect->findByPage(array($Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($TermCollectAll->count(), $Config->getValue(), "/setting/termcollect" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'TermCollect');
			$request->setProperty('Page'		, $Page);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TermCollectAll1', $TermCollectAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>