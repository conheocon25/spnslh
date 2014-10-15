<?php		
	namespace MVC\Command;	
	class SettingTermPaid extends Command {
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
			$TermPaidAll = $mTermPaid->findAll();
						
			$Title = "DANH MỤC CHI";
			$Navigation = array(				
				array("THIẾT LẬP", "/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$TermPaidAll1 	= $mTermPaid->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($TermPaidAll->count(), $Config->getValue(), "/setting/termpaid" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'TermPaid');
			$request->setProperty('Page'		, $Page);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TermPaidAll1'	, $TermPaidAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>