<?php
	namespace MVC\Command;	
	class SettingProjectDocument extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Id = $request->getProperty('Id');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Project = $mProject->find($Id);
			
			$Navigation = array(				
				array("Quản lý", "/setting"),
				array("Dự án", "/setting/project")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Project', $Project);
			
			$request->setProperty('Title', 'Tài liệu');
			$request->setProperty('ActiveLeftMenu', 'SettingProject');
			$request->setObject('Navigation', $Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>