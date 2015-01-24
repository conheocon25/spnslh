<?php		
	namespace MVC\Command;	
	class ASettingCategoryPost extends Command {
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
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryPostAll = $mCategoryPost->findAll();
						
			$Title = "DANH MỤC BÀI VIẾT";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$CategoryPostAll1 = $mCategoryPost->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CategoryPostAll->count(), $Config->getValue(), "/setting/CategoryPost" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'CategoryPost');
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryPostAll1'	, $CategoryPostAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>