<?php
	namespace MVC\Command;	
	class SettingPagodaInfoLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mPagoda = new \MVC\Mapper\Pagoda();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$Pagoda		= $mPagoda->find(1);
			if (!isset($Pagoda)){
				$Pagoda = new \MVC\Domain\Pagoda(
					null,
					"",
					1
				);
				$mPagoda->insert($Pagoda);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("CHÙA", 		"/quan-ly/chua")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Pagoda', 			$Pagoda);						
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingPagoda');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>