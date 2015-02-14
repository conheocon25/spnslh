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
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mPost 			= new \MVC\Mapper\Post();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryPostAll	= $mCategoryPost->findAll();
			if (!isset($IdCategory)){
				$IdCategory = $CategoryPostAll->current()->getId();
			}
			
			$Category		= $mCategoryPost->find($IdCategory);
			$PostAll 		= $mPost->findBy(array($IdCategory));
									
			$Title 			= mb_strtoupper($Category->getName(), 'UTF8')." / BÀI VIẾT";
			$Navigation 	= array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryPostAll'	, $CategoryPostAll);			
			$request->setObject('Category'			, $Category);
			$request->setObject('PostAll'			, $PostAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>