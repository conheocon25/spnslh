<?php
	namespace MVC\Command;	
	class SettingCategoryCourseUpdLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCourse = $request->getProperty("IdCourse");
			$IdCategory = $request->getProperty("IdCategory");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mCategory = new \MVC\Mapper\Category();
			$mCourse = new \MVC\Mapper\Course();
			$mUnit = new \MVC\Mapper\Unit();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Category = $mCategory->find($IdCategory);
			$CategoryAll = $mCategory->findAll();
			$Course = $mCourse->find($IdCourse);			
			$UnitAll = $mUnit->findAll();
			
			$Title = mb_strtoupper($Course->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting"),
				array("DANH MỤC MÓN", "/setting/category"),
				array(mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLCourse())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("UnitAll", $UnitAll);
			$request->setObject("Category", $Category);
			$request->setObject("CategoryAll", $CategoryAll);
			$request->setObject("Course", $Course);
			$request->setProperty("Title", $Title);
			$request->setObject("Navigation", $Navigation);
		}
	}
?>