<?php		
	namespace MVC\Command;	
	class ASettingStoryLine extends Command {
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
			$mStoryLine = new \MVC\Mapper\StoryLine();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$StoryLineAll 	= $mStoryLine->findAll();
						
			$Title 			= "CÂU CHUYỆN KHÁCH HÀNG";
			$Navigation 	= array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			$StoryLineAll1 = $mStoryLine->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($StoryLineAll->count(), $Config->getValue(), "/setting/storyline" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'StoryLine');
			$request->setProperty('Page'		, $Page);			
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('StoryLineAll1'	, $StoryLineAll1);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>