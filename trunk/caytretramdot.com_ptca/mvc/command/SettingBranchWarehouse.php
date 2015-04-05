<?php
	namespace MVC\Command;	
	class SettingBranchWarehouse extends Command {
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
			$IdBranch 	= $request->getProperty('IdBranch');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mBranchGroup 	= new \MVC\Mapper\BranchGroup();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$WarehouseAll	= $mWarehouse->findAll();
			$Group 			= $mBranchGroup->find($IdGroup);
			$Branch 		= $mBranch->find($IdBranch);
			
			$Title = mb_strtoupper($Branch->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("ĐƠN VỊ", "/ql-thiet-lap/don-vi-truc-thuoc"),
				array(mb_strtoupper($Group->getName(), 'UTF8'), $Group->getURLSetting() )
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setObject('Group'				, $Group);
			$request->setObject('Branch'			, $Branch);	
			$request->setObject('WarehouseAll'		, $WarehouseAll);
			
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>