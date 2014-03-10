<?php
	namespace MVC\Command;	
	class SettingMHotelInfoExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$Introduction	= \stripslashes($request->getProperty('Introduction'));
			$Count 			= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mMHotel = new \MVC\Mapper\MHotel();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$MHotel = $mMHotel->find(1);
			$MHotel->setIntroduction($Introduction);			
			$MHotel->setCount($Count);
			$mMHotel->update($MHotel);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>