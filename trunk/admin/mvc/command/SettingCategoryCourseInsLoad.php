<?php	
	namespace MVC\Command;
	class SettingCategoryCourseInsLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategory = new \MVC\Mapper\Category();
			$mCourse = new \MVC\Mapper\Course();
			$mUnit = new \MVC\Mapper\Unit();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------	
			$UnitAll = $mUnit->findAll();
			$Category = $mCategory->find($IdCategory);
			
			$Title = "THÊM MỚI";
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting"),
				array("DANH MỤC MÓN", "/setting/category"),
				array(mb_strtoupper($Category->getName(), 'UTF8'), $Category->getURLCourse())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty("Title", $Title);
			$request->setObject("Navigation", $Navigation);
			
			$request->setObject("UnitAll", $UnitAll);
			$request->setObject("Category", $Category);
						
		}
	}
?>