<?php		
	namespace MVC\Command;	
	class ASettingCategoryVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdBuddha 	= $request->getProperty('IdBuddha');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBuddha 	= new \MVC\Mapper\CategoryBuddha();
			$mCategoryVideo 	= new \MVC\Mapper\CategoryVideo();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
						
			$Title = "DANH MỤC VIDEO";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			if (!isset($IdBuddha)) $Buddha=$CategoryBuddhaAll->current();
			else{
				$Buddha = $mCategoryBuddha->find($IdBuddha);
			}
			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			
			$CategoryVideoAll1 = $mCategoryVideo->findBy(array($Buddha->getId()));
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'CategoryVideo');			
			$request->setObject('Navigation'		, $Navigation);
			$request->setObject('ConfigName'		, $ConfigName);
			
			$request->setObject('Buddha'			, $Buddha);
			$request->setObject('CategoryBuddhaAll'	, $CategoryBuddhaAll);
			$request->setObject('CategoryVideoAll1'	, $CategoryVideoAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>