<?php
	namespace MVC\Command;	
	class SettingProjectNewsInsLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$IdProject = $request->getProperty("IdProject");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Project = $mProject->find($IdProject);
			
			$Navigation = array(				
				array("Quản lý", "/setting"),
				array("Dự án", "/setting/project"),
				array("Tin tức", $Project->getURLSettingNews())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'Navigation', $Navigation );
			$request->setObject( 'Project', $Project );
			$request->setProperty('ActiveLeftMenu', 'SettingProject');
			$request->setProperty('Title', 'Thêm mới');

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
