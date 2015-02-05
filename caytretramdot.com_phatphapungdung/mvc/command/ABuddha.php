<?php		
	namespace MVC\Command;	
	class ABuddha extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryVideo 	= new \MVC\Mapper\CategoryVideo();
			$mCategoryBuddha 	= new \MVC\Mapper\CategoryBuddha();
			$mConfig			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryBuddhaAll	= $mCategoryBuddha->findAll();
			if (!isset($IdCategoryBuddha)){
				$IdCategoryBuddha = $CategoryBuddhaAll->current()->getId();
			}			
			$Buddha		= $mCategoryBuddha->find($IdCategoryBuddha);
												
			$Title 			= mb_strtoupper($Buddha->getName(), 'UTF8')." / VIDEO";
			$Navigation 	= array();
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Buddha');			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'		, $ConfigName);
			$request->setObject('CategoryBuddhaAll'	, $CategoryBuddhaAll);			
			$request->setObject('Buddha'			, $Buddha);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>