<?php
	namespace MVC\Command;
	class SellingDomainTableSessionDetailDelExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSessionDetail = $request->getProperty("IdSessionDetail");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSession = new \MVC\Mapper\Session();
			$mSD = new \MVC\Mapper\SessionDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$SD = $mSD->find($IdSessionDetail);										
			$Session = $SD->getSession();
			$mSD->delete(array($IdSessionDetail));
			
			$Session->setValue( $Session->getReValue() );
			$mSession->update($Session);
			
			$IdSession = $Session->getId();
			$IdTable = $Session->getIdTable();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('IdTable', $IdTable);
			$request->setProperty('IdSession', $IdSession);
			
			return self::statuses('CMD_OK');
		}
	}
?>
