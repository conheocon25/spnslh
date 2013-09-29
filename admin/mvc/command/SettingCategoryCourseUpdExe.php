<?php	
	namespace MVC\Command;
	class SettingCategoryCourseUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
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
			$Name = $request->getProperty("Name");
			$ShortName = $request->getProperty("Name");
			$Unit = $request->getProperty("Unit");
			$Price1 = $request->getProperty("Price1");
			$Price2 = $request->getProperty("Price2");
			$Price3 = $request->getProperty("Price3");
			$Price4 = $request->getProperty("Price4");
			$Rate = $request->getProperty("Rate");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCourse = new \MVC\Mapper\Course();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Course = $mCourse->find($IdCourse);
			if (!isset($Name) || !isset($Price1) || !isset($Unit) )
				return self::statuses('CMD_OK');
				
			$Course->setIdCategory($IdCategory);
			$Course->setName($Name);
			$Course->setShortName($ShortName);
			$Course->setUnit($Unit);
			$Course->setPrice1($Price1);
			$Course->setPrice2($Price2);
			$Course->setPrice3($Price3);
			$Course->setPrice4($Price4);
			$Course->setRate($Rate);			
			$mCourse->update($Course);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>