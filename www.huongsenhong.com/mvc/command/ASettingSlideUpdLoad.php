<?php		
	namespace MVC\Command;	
	class ASettingSlideUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdPresentation = $request->getProperty('IdPresentation');
			$IdSlide 		= $request->getProperty('IdSlide');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig		= new \MVC\Mapper\Config();
			$mSlide 		= new \MVC\Mapper\Slide();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH			
			//-------------------------------------------------------------
			$Slide 			= $mSlide->find($IdSlide);
			$Presentation 	= $mPresentation->find($IdPresentation);
			
			$Title = mb_strtoupper($Slide->getName(), 'UTF8');
			$Navigation = array(
				array("THIẾT LẬP", "/admin/setting"),
				array("TRÌNH BÀY", "/admin/setting/presentation"),
				array(mb_strtoupper($Presentation->getName(), 'UTF8'), $Presentation->getURLSetting())
				
			);						
			$ConfigName = $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Presentation'	, $Presentation);
			$request->setObject('Slide'			, $Slide);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>