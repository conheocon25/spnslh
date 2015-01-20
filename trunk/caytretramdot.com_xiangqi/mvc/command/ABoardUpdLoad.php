<?php		
	namespace MVC\Command;	
	class ABoardUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory 	= $request->getProperty('IdCategory');
			$IdBoard 		= $request->getProperty('IdBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCBM 		= new \MVC\Mapper\CBM();
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																																	
			$CBM 		= $mCBM->find($IdBoard);
			$Category 	= $CBM->getCategory();
			
			$Title 		= $CBM->getName();
			$Navigation = array(								
				array(\mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLSetting()),
			);
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('CBM'			, $CBM);
			$request->setObject('Category'		, $Category);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>