<?php
	namespace MVC\Command;	
	class ASlideInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdPresentation 	= $request->getProperty('IdPresentation');
			$Name 				= $request->getProperty('Name');
			$Order				= $request->getProperty('Order');
			$Note 				= \stripslashes($request->getProperty('Note'));			
			$URL	 			= $request->getProperty('URL');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSlide = new \MVC\Mapper\Slide();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Slide = new \MVC\Domain\Slide(
				null,
				$IdPresentation,
				$Name,
				$Order,
				$Note,
				$URL				
			);									
			$mSlide->insert($Slide);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
