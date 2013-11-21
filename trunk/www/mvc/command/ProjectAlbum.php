<?php
	namespace MVC\Command;	
	class ProjectAlbum extends Command {
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

			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Navigation = array(				
				array("Dự án", "/project")
			);

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 'Album ảnh');
			$request->setProperty('ActiveTopMenu', 'Project');
			$request->setProperty('ActiveLeftMenu', 'ProjectAlbum');
			$request->setObject('Navigation', $Navigation);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>