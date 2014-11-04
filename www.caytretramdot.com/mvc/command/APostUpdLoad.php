<?php		
	namespace MVC\Command;	
	class APostUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTag 	= $request->getProperty('IdTag');
			$IdPost = $request->getProperty('IdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPT 	= new \MVC\Mapper\PostTag();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$PTAll 	= $mPT->findByTagPost(array($IdTag, $IdPost));
			$PT		= $PTAll->current();
			
			$Tag 	= $PT->getTag();
			$Post 	= $PT->getPost();
			
			$Title 	= "CẬP NHẬT";
			$Navigation = array(								
				array(\mb_strtoupper($Tag->getName(), 'UTF8'), $Tag->getURLSettingPost()),
				array(\mb_strtoupper($Post->getTitle(), 'UTF8'), $PT->getURLSetting())
			);									
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('PT'			, $PT);
			$request->setObject('Post'			, $Post);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>