<?php		
	namespace MVC\Command;	
	class CheckingUpdate extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$DataId 	= $request->getProperty("DataId");
			$DataState 	= $request->getProperty("DataState");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSession = new \MVC\Mapper\Session();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			for ($i=0; $i< count($DataId); $i++){
				$Sesssion = $mSession->find($DataId[$i]);
				$Sesssion->setState($DataState[$i]);
				if ($DataState[$i]==0){
					$Sesssion->setCountMonth(0);
					$Sesssion->setDateJoined('0000-0-0');
				}else{
					$Sesssion->setCountMonth(12);
				}
				
				$mSession->update($Sesssion);
			}
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>