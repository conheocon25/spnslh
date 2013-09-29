<?php
	namespace MVC\Command;
	class SellingDomainTableEvalExe extends Command{
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
			$DateTimeEnd = $request->getProperty("DateTimeEnd");
			$DateTime = $request->getProperty("DateTime");
			//$IdEmployee = 1;//Tạm lấy mặc định
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Table = $mTable->find($IdTable);			
			$Session = $Table->getSessionActive();	
			//$DateTimeEnd = $Session->getDateTimeEnd1();
			if (isset($DateTimeEnd)){
				//Update lại giờ kết thúc
				$Session->setDateTime($DateTime);
				$Session->setDateTimeEnd($DateTimeEnd);
				$Session->setStatus(1);
				$mSession->update($Session);
			}
			/*
			$NewDomainSession = new \MVC\Domain\Session(
				null,
				$IdTable, 
				1, 
				1, 
				null,
				null,					
				"Karaoke Ba Đức",
				"",
				0,
				0,
				0
			);
			$mSession->insert($NewDomainSession);
			*/
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
