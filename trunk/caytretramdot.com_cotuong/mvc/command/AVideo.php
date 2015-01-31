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
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryVideo 	= new \MVC\Mapper\CategoryVideo();
			$mVideo 			= new \MVC\Mapper\Video();
			$mConfig			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryVideoAll	= $mCategoryVideo->findAll();
			if (!isset($IdCategory)){
				$IdCategory = $CategoryVideoAll->current()->getId();
			}
			
			$Category		= $mCategoryVideo->find($IdCategory);
			$VideoAll 		= $mVideo->findBy(array($IdCategory));
									
			$Title 			= mb_strtoupper($Category->getName(), 'UTF8')." / VIDEO";
			$Navigation 	= array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Video');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryVideoAll'	, $CategoryVideoAll);			
			$request->setObject('Category'			, $Category);
			$request->setObject('VideoAll'			, $VideoAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>