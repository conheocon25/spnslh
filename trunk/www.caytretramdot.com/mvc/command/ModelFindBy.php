<?php
	namespace MVC\Command;	
	class ModelFindBy extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			\Header('Content-type: text/xml');
			require_once("mvc/base/domain/HelperFactory.php");	
						
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$ObjectName = $request->getProperty('ObjectName');
			$IdObject 	= $request->getProperty('IdObject');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$mMapper 	= \MVC\Domain\HelperFactory::getFinder($ObjectName);			
			$ObjAll 	= $mMapper->findBy(array($IdObject));
			
			$S = "";
			while ($ObjAll->valid()){
				$Obj = $ObjAll->current();
				$S1 = str_replace('&', '&amp;', $Obj->toXML());				
				$S = $S.$S1;
				$ObjAll->next();
			}			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			echo "<model>".trim($S)."</model>";
		}
	}
?>