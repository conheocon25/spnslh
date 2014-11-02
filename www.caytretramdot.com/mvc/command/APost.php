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
			$mTag 	= new \MVC\Mapper\Tag();
			$mPT 	= new \MVC\Mapper\PostTag();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TagAll 	= $mTag->findAll();
			if (!isset($IdTag)){
				$IdTag = $TagAll->current()->getId();
			}
			
			$Tag 		= $mTag->find($IdTag);
			$PTAll 		= $mPT->findByTag(array($IdTag));
									
			$Title = "BÀI VIẾT";
			$Navigation = array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('TagAll'		, $TagAll);
			$request->setProperty('Tag'			, $Tag);
			$request->setObject('PTAll'			, $PTAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>