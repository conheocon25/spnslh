<?php
	namespace MVC\Command;	
	class SettingCategoryCourse extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty("Page");
			$IdCategory = $request->getProperty("IdCategory");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategory 	= new \MVC\Mapper\Category();
			$mCourse 	= new \MVC\Mapper\Course();
			$mConfig 	= new \MVC\Mapper\Config();
			$mUnit 		= new \MVC\Mapper\Unit();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$UnitAll 		= $mUnit->findAll();
			$CategoryAll 	= $mCategory->findAll();
			$Category 		= $mCategory->find($IdCategory);
			
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/setting"),
				array("DANH MỤC MÓN", "/setting/category")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
			$CourseAll 	= $mCourse->findByPage(array($IdCategory, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($Category->getCourseAll()->count(), $Config->getValue(), $Category->getURLCourse());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Category"		, $Category);
			$request->setObject("UnitAll"		, $UnitAll);
			$request->setObject("CategoryAll"	, $CategoryAll);
			$request->setObject("CourseAll"		, $CourseAll);
			$request->setObject("ConfigName"	, $ConfigName);
			
			$request->setProperty("Title"		, $Title);
			$request->setProperty("Page"		, $Page);
			$request->setObject("Navigation"	, $Navigation);
			$request->setObject("PN"			, $PN);
		}
	}
?>