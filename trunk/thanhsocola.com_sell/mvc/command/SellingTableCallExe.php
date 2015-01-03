<?php
	namespace MVC\Command;
	class SellingTableCallExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSession 	= $request->getProperty("IdSession");
			$IdCourse 	= $request->getProperty("IdCourse");						
			$Delta 		= $request->getProperty("Delta");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTable 	= new \MVC\Mapper\Table();			
			$mCategory 	= new \MVC\Mapper\Category();
			$mCourse 	= new \MVC\Mapper\Course();
			$mSession 	= new \MVC\Mapper\Session();
			$mEmployee 	= new \MVC\Mapper\Employee();
			$mSD 		= new \MVC\Mapper\SessionDetail();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Course = $mCourse->find($IdCourse);
			
			$EmployeeAll = $mEmployee->findAll();
			$Employee = $EmployeeAll->current();
			if (!isset($Employee)){
				$IdEmployee = 0;
			}else{
				$IdEmployee = $Employee->getId();
			}
			
			$Session = $mSession->find($IdSession);
			
			//Kiểm tra xem IdCourse đã có tồn tại trong Session hiện tại chưa
			$IdSD 	= $mSD->check(array($IdSession, $IdCourse));			
			$Count 	= 1;
			if ($IdSD < 1){				
				$SD = new \MVC\Domain\SessionDetail(
					null,
					$IdSession, 
					$IdCourse, 
					1,
					$Course->getPrice1()
				);
				$mSD->insert($SD);				
			}else{				
				$SD = $mSD->find($IdSD);
				$Count = $SD->getCount() + 1;
				$SD->setCount($Count);
				$mSD->update($SD);
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setObject("SD", $SD);
		}
	}
?>