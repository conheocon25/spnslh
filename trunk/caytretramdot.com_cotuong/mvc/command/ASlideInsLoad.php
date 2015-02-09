<?php		
	namespace MVC\Command;	
	class ASlideInsLoad extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig		= new \MVC\Mapper\Config();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH			
			//-------------------------------------------------------------
			$Presentation 		= $mPresentation->find($IdPresentation);
			
			$Title = mb_strtoupper($Presentation->getName(), 'UTF8');
			$Navigation = array(
				array("THIẾT LẬP", "/admin/setting"),
				array("TRÌNH BÀY", "/admin/setting/presentation")
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
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>