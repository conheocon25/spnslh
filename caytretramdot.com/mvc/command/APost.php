<?php		
	namespace MVC\Command;	
	class APost extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTag = $request->getProperty('IdTag');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTag 		= new \MVC\Mapper\Tag();
			$mPT 		= new \MVC\Mapper\PostTag();			
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$User 		= $Session->getCurrentUser();
			$TagAll		= $mTag->findAll();
			if (!isset($IdTag)){
				$IdTag = $TagAll->current()->getId();
			}
			
			$Tag 			= $mTag->find($IdTag);
			$PTAll 			= $mPT->findByUserTag(array($Session->getCurrentIdUser(), $IdTag));
									
			$Title 			= mb_strtoupper($Tag->getName(), 'UTF8')." / BÀI VIẾT";
			$Navigation 	= array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('TagAll'		, $TagAll);
			$request->setProperty('User'		, $User);
			$request->setProperty('Tag'			, $Tag);
			$request->setObject('PTAll'			, $PTAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>