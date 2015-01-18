<?php
	namespace MVC\Command;	
	class ObjectUpd extends Command {
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
			$Data = $request->getProperty('Data');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mMapper 	= \MVC\Domain\HelperFactory::getFinder($ObjectName);
			$Domain 	= $mMapper->find($Data[0]);			
			$Domain->setArray($Data);
			$mMapper->update($Domain);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>