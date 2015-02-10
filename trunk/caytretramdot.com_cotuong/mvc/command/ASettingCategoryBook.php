<?php		
	namespace MVC\Command;	
	class ASettingCategoryBook extends Command {
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
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryBookAll = $mCategoryBook->findAll();
						
			$Title = "DANH MỤC SÁCH";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$PresentationAll 	= $mPresentation->findAll();
			$CategoryBookAll1 	= $mCategoryBook->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CategoryBookAll->count(), $Config->getValue(), "/setting/CategoryBook" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'CategoryBook');
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			
			$request->setObject('CategoryBookAll1'	, $CategoryBookAll1);
			$request->setObject('PresentationAll'	, $PresentationAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>