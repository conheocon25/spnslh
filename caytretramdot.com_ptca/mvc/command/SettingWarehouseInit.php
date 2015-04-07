<?php
	namespace MVC\Command;	
	class SettingWarehouseInit extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdGroup 	= $request->getProperty('IdGroup');
			$IdWarehouse= $request->getProperty('IdWarehouse');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mGood 			= new \MVC\Mapper\Good();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$GoodAll 		= $mGood->findAll();
			$WarehouseAll 	= $mWarehouse->findByGroup(array($IdGroup));
			$Warehouse 		= $mWarehouse->find($IdWarehouse);
																		
			$Title 	= "KHỞI TẠO DỮ LIỆU";
			$Navigation = array(
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("NHÓM KHO HÀNG", "/ql-thiet-lap/kho-hang"),
				array($Warehouse->getName(), $Warehouse->getGroup()->getURLSetting())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('WarehouseAll'	, $WarehouseAll);
			$request->setObject('GoodAll'		, $GoodAll);
			$request->setObject('Warehouse'		, $Warehouse);
			
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>