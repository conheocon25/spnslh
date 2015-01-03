<?php		
	namespace MVC\Command;	
	class APostInsLoad extends Command{
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
			$mPost 		= new \MVC\Mapper\Post();
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Tag 		= $mTag->find($IdTag);
			
			$Title = mb_strtoupper($Tag->getName(), 'UTF8')." > THÊM MỚI";
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("BÀI VIẾT", 	$Tag->getURLSettingPost())
			);
			
			$ConfigName	= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Tag'			, $Tag);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>