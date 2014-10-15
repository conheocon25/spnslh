<?php
	namespace MVC\Command;
	class SellingTableMergeExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------						
			$IdTable = $request->getProperty("IdTable");
			$IdTableMerge = $request->getProperty("IdTableMerge");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
						
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
			$mSessionDetail = new \MVC\Mapper\SessionDetail();		
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Table = $mTable->find($IdTable);
			$TableMerge = $mTable->find($IdTableMerge);
			
			$SessionA = $Table->getSessionActive();
			$SessionB = $TableMerge->getSessionActive();
			
			$SDA = $SessionA->getDetails();
			$SDB = $SessionB->getDetails();
			
			while ($SDA->valid()){
				$SD = $SDA->current();
				$SD->setIdSession($SessionB->getId());
				$mSessionDetail->update($SD);
				$SDA->next();
			}			
			$mSession->delete(array($SessionA->getId()));
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
