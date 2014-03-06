<?php
	namespace MVC\Command;	
	class SettingCChessInfoLoad extends Command {
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
			$mCChess = new \MVC\Mapper\CChess();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title		= "THÔNG TIN";
			$CChess		= $mCChess->find(1);
			if (!isset($CChess)){
				$CChess = new \MVC\Domain\CChess(
					null,
					"",
					1
				);
				$mCChess->insert($CChess);
			}
			
			$Navigation = array(
				array("QUẢN LÝ", 	"/quan-ly"),
				array("CỜ TƯỚNG", 	"/quan-ly/co-tuong")
			);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('CChess', 			$CChess);						
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveLeftMenu', 'SettingCChess');
			$request->setObject('Navigation', 		$Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>