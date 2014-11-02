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
			$mPost 	= new \MVC\Mapper\Post();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Post 	= $mPost->find($IdPost);
			$Title 	= mb_strtoupper($Post->getTitle(), 'UTF8');
			$Navigation = array(								
				array("BÀI VIẾT", 	"/admin/post")
			);									
			$ConfigName		= $mConfig->findByName("NAME");
			$URLExe = "/admin/post/$IdTag/$IdPost/upd/exe";
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('URLExe'		, $URLExe);
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Post'			, $Post);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>