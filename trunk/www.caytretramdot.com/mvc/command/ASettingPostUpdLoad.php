<?php		
	namespace MVC\Command;	
	class ASettingPostUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdPost = $request->getProperty('IdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mPost 	= new \MVC\Mapper\Post();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Post 	= $mPost->find($IdPost);
			$Title 	= mb_strtoupper($Post->getTitle(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("BÀI VIẾT", 	"/admin/setting/post")				
			);									
			$ConfigName		= $mConfig->findByName("NAME");
			
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Post'			, $Post);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>