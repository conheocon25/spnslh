<?php		
	namespace MVC\Command;	
	class ASettingCategoryBoard extends Command {
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
			$mCategoryBoard 	= new \MVC\Mapper\CategoryBoard();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryBoardAll = $mCategoryBoard->findAll();
						
			$Title = "DANH MỤC VÁN CỜ";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$CategoryBoardAll1 = $mCategoryBoard->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CategoryBoardAll->count(), $Config->getValue(), "/setting/CategoryBoard" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'CategoryBoard');
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryBoardAll1'	, $CategoryBoardAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>