<?php		
	namespace MVC\Command;	
	class Setting extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mConfig = new \MVC\Mapper\Config();
			$mCourseDefault = new \MVC\Mapper\CourseDefault();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$ConfigName = $mConfig->findByName("NAME");
			/*
			$CD = $mCourseDefault->findAll();
			while($CD->valid()){
				$C = $CD->current();
				echo $C->getCourse()->getName(). "-".$C->getCount();
				$CD->next();
			}
			*/
			$Title = "THIẾT LẬP";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'Setting');
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>