<?php		
	namespace MVC\Command;	
	class ACoursePostIns extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCourse = $request->getProperty('IdCourse');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCourse 	= new \MVC\Mapper\Course();			
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Course 	= $mCourse->find($IdCourse);
			
			$Title 		= "THÊM MỚI";
			$Navigation = array(
				array("MÓN ĂN", 	"/admin/course"),
				array(mb_strtoupper($Course->getName(), 'UTF8')." / BÀI VIẾT", $Course->getURLSettingPost())
			);
			
			$ConfigName	= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Course'		, $Course);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>