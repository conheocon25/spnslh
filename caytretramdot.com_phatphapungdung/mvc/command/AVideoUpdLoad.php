<?php		
	namespace MVC\Command;	
	class AVideoUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdVideo 		= $request->getProperty('IdVideo');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mVideo 	= new \MVC\Mapper\Video();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$Video 		= $mVideo->find($IdVideo);
			$Category 	= $Video->getCategory();
			$Buddha 	= $Category->getCategory();
			
			$Title 		= $Video->getTitle();
			$Navigation = array(
				array(mb_strtoupper($Buddha->getName(), 'UTF8'), 	$Buddha->getURLSetting()),
				array(\mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLSetting()),
			);
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('ActiveAdmin'	, 'Video');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('Video'			, $Video);
			$request->setObject('Category'		, $Category);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>