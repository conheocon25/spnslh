<?php
	namespace MVC\Command;	
	class SettingRestaurantInfoExe extends Command{
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
			$mRestaurant = new \MVC\Mapper\Restaurant();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$Restaurant = $mRestaurant->find(1);
			$Restaurant->setIntroduction($Introduction);			
			$Restaurant->setCount($Count);
			$mRestaurant->update($Restaurant);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>