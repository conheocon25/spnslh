<?php
	namespace MVC\Command;	
	class SettingProjectUpdLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
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
			$request->setObject( 'Project', $Project );
			$request->setObject( 'Navigation', $Navigation );
			$request->setProperty("ActiveLeftMenu", 'SettingProject');
			$request->setProperty("Title", "Cập nhật: ".$Project->getName());

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
