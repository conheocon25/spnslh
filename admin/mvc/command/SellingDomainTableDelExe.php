<?php
	namespace MVC\Command;
	class SellingDomainTableDelExe extends Command{
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
			$IdEmployee = 1;//Tạm lấy mặc định
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($IdTable))
				return self::statuses('CMD_OK');
				
			$Table = $mTable->find($IdTable);			
			$Session = $Table->getSessionActive();				
			$mSession->delete(array($Session->getId()));
						
			$NewDomainSession = new \MVC\Domain\Session(
				null,
				$IdTable,
				1, 
				1, 
				null,
				null,					
				"Thử nghiệm",
				"Chưa"
			);
			$mSession->insert($NewDomainSession);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
