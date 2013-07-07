<?php
	namespace MVC\Command;	
	class AgencyRegisterInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Email = $request->getProperty('Email');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Agency = new \MVC\Domain\Agency(
				null,
				"a",
				"b",
				$Email,
				"c"
			);			
			$mAgency->insert($Agency);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
						
			return self::statuses('CMD_OK');
		}
	}
?>