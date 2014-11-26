<?php
	namespace MVC\Command;
	class SellingLogCoursePreparePrint extends Command{
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
			$mCL 	= new \MVC\Mapper\CourseLog();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CLAll 	= $mCL->findByPrint(array());
			
			//Cập nhật trạng thái qua BẾP
			while ($CLAll->valid()){
				$CL = $CLAll->current();
				$CL->setState(1);
				$mCL->update($CL);
				$CLAll->next();
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("CLAll", $CLAll);
		}
	}
?>
