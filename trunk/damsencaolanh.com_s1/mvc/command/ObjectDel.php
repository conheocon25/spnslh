<?php
	namespace MVC\Command;	
	class ObjectDel extends Command {
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
			$ListId = $request->getProperty('ListId');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mMapper 	= \MVC\Domain\HelperFactory::getFinder($ObjectName);
						
			if (!isset($ListId)){
				$mMapper->delete(array($Id));
			}else{
				foreach ($ListId as $Id )
					$mMapper->delete(array($Id));
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
						
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>