<?php
	namespace MVC\Command;	
	class ObjectLiked extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");	
			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$ObjectName = $request->getProperty('ObjectName');
			$Id = $request->getProperty('Id');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mMapper 	= \MVC\Domain\HelperFactory::getFinder($ObjectName);
			$Obj 		= $mMapper->find($Id);
			$Obj->setLiked( $Obj->getLiked() + 1);
			$mMapper->update($Obj);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			echo $Obj->toJSON();
		}
	}
?>