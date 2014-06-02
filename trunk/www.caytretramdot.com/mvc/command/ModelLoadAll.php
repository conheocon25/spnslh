<?php
	namespace MVC\Command;	
	class ModelLoadAll extends Command {
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
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$mMapper 	= \MVC\Domain\HelperFactory::getFinder($ObjectName);
			//$mMapper 	= new \MVC\Mapper\VideoCategory();
			$ObjAll 	= $mMapper->findAll();
			$S = "";
			while ($ObjAll->valid()){
				$Obj = $ObjAll->current();
				$S = $S.trim($Obj->toXML());
				$ObjAll->next();
			}
			//echo $ObjectName;
			//echo $ObjAll->current()->toXML();
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			echo "<model>".trim($S)."</model>";
		}
	}
?>