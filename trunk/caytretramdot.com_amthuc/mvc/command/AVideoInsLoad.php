<?php		
	namespace MVC\Command;	
	class AVideoInsLoad extends Command{
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
			$Buddha 	= $mCategoryBuddha->find($IdCategoryBuddha);
			$Category 	= $mCategoryVideo->find($IdCategoryVideo);
			
			$Title = "THÊM MỚI VIDEO";
			$Navigation = array(
				array(mb_strtoupper($Buddha->getName(), 'UTF8'), 	$Buddha->getURLSetting()),
				array(mb_strtoupper($Category->getName(), 'UTF8'), 	$Category->getURLSetting()),
			);
			
			$ConfigName	= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Video');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Category'		, $Category);
			$request->setObject('Buddha'		, $Buddha);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>