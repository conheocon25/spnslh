<?php		
	namespace MVC\Command;	
	class AVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategoryBuddha = $request->getProperty('IdCategoryBuddha');
			$IdCategoryVideo = $request->getProperty('IdCategoryVideo');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBuddha 	= new \MVC\Mapper\CategoryBuddha();
			$mCategoryVideo 	= new \MVC\Mapper\CategoryVideo();
			$mVideo 			= new \MVC\Mapper\Video();
			$mConfig			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Buddha			= $mCategoryBuddha->find($IdCategoryBuddha);
			$Category		= $mCategoryVideo->find($IdCategoryVideo);
												
			$Title 			= mb_strtoupper($Category->getName(), 'UTF8')." / VIDEO";
			$Navigation 	= array(
				array(mb_strtoupper($Buddha->getName(), 'UTF8'), 	$Buddha->getURLSetting())
			);
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Video');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('Buddha'			, $Buddha);			
			$request->setObject('Category'			, $Category);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>