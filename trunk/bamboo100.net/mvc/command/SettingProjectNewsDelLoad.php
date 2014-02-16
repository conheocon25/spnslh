<?php
	namespace MVC\Command;	
	class SettingProjectNewsDelLoad extends Command{
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
			$IdNews = $request->getProperty("IdNews");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Project = $mProject->find($IdProject);
			$PNews = $mPNews->find($IdNews);
			
			$Navigation = array(				
				array("Quản lý", "/setting"),
				array("Dự án", "/setting/project"),
				array("Tin tức", $Project->getURLSettingNews())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject( 'Navigation', $Navigation );
			$request->setObject( 'PNews', $PNews );
			$request->setProperty('ActiveLeftMenu', 'SettingProject');
			$request->setProperty('Title', 'Thêm mới');

			return self::statuses('CMD_DEFAULT');
		}
	}
?>
