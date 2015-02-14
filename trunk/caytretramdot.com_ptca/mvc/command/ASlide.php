<?php		
	namespace MVC\Command;	
	class ASlide extends Command {
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
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$PresentationAll 	= $mPresentation->findAll();
			$Presentation 		= $mPresentation->find($IdPresentation);
						
			$Title = mb_strtoupper($Presentation->getName(), 'UTF8');
			$Navigation = array(				
				array("TRÌNH BÀY", "/admin/presentation")
			);			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Presentation');			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('PresentationAll', $PresentationAll);
			$request->setObject('Presentation', $Presentation);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>