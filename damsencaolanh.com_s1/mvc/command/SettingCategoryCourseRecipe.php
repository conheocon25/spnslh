<?php
	namespace MVC\Command;
	class SettingCategoryCourseRecipe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty("IdCategory");
			$IdCourse = $request->getProperty("IdCourse");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategory = new \MVC\Mapper\Category();
			$mCourse = new \MVC\Mapper\Course();
			$mResource = new \MVC\Mapper\Resource();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Course 		= $mCourse->find($IdCourse);
			$Category 		= $mCategory->find($IdCategory);
			$ResourceAll 	= $mResource->findAll();
			$Title = mb_strtoupper($Course->getName(), 'UTF8')." CÔNG THỨC";
			
			$Navigation = array(				
				array("THIẾT LẬP", "/setting"),
				array("DANH MỤC MÓN", "/setting/category"),
				array(mb_strtoupper($Category->getName(), "UTF8"), $Category->getURLCourse())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Course"		, $Course);
			$request->setObject("ResourceAll"	, $ResourceAll);			
			$request->setProperty( "Title"		, $Title);
			$request->setObject("Navigation"	, $Navigation);
		}
	}
?>