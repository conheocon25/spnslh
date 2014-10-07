<?php
	namespace MVC\Command;
	class SellingTableMoveExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTable1 = $request->getProperty("IdTable");
			$IdTable2 = $request->getProperty("IdTableMove");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
						
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Table1 = $mTable->find( $IdTable1 );
			$Table2 = $mTable->find( $IdTable2 );
			
			//Chuyển Session2 sang qua Session1
			$Session1 = $Table1->getSessionActive();
			$Session1->setIdTable($IdTable2);
			$mSession->update($Session1);
													
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
