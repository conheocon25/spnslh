<?php
	namespace MVC\Command;	
	class SettingUnitUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdUnit = $request->getProperty("IdUnit");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mUnit = new \MVC\Mapper\Unit();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Unit = $mUnit->find($IdUnit);
			$Title = mb_strtoupper($Unit->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting"),
				array("ĐƠN VỊ TÍNH", "/setting/unit")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------	
			$request->setObject("Unit", $Unit);		
			$request->setObject("Navigation", $Navigation);
			$request->setProperty('Title', $Title);
		}
	}
?>