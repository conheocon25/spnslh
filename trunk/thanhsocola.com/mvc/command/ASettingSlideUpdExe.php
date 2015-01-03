<?php
	namespace MVC\Command;	
	class ASettingSlideUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdSlide 			= $request->getProperty('IdSlide');
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
			$Slide = $mSlide->find($IdSlide);
			$Slide->setName($Name);	
			$Slide->setOrder($Order);
			$Slide->setURL($URL);
			$Slide->setNote($Note);
			$mSlide->update($Slide);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
