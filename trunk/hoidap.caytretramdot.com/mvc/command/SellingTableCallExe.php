<?php
	namespace MVC\Command;
	class SellingTableCallExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session1 = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTable 	= $request->getProperty("IdTable");
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
			$Table = $mTable->find($IdTable);
			$Course = $mCourse->find($IdCourse);
			
			$EmployeeAll = $mEmployee->findAll();
			$Employee = $EmployeeAll->current();
			if (!isset($Employee)){
				$IdEmployee = 0;
			}else{
				$IdEmployee = $Employee->getId();
			}
			
			//Nếu chưa có Session thì tạo
			$Session = $Table->getSessionActive();			
			if (!isset($Session)){
				$Session = new \MVC\Domain\Session(
					null,					//Id
					$IdTable,				//IdTable
					$Session1->getCurrentIdUser(),//IdUser
					1,						//IdCustomer	
					$IdEmployee,			//IdEmployee
					\date("Y-m-d H:i:s"), 	//DateTime
					null, 					//DateTimeEnd
					"",						//Note
					"",						//Status
					0,						//DiscountValue	
					0,						//DiscountPercent
					0,						//Surtax
					0						//Payment
				);
				$IdSession = $mSession->insert($Session);
								
			}
			$IdSession = $Session->getId();
						
			//Kiểm tra xem IdCourse đã có tồn tại trong Session hiện tại chưa
			$IdSD = $mSD->check(array($IdSession, $IdCourse));
			$Count = 1;
			if (!isset($IdSD) || $IdSD==null){
				$SD = new \MVC\Domain\SessionDetail(
					null,
					$IdSession, 
					$IdCourse, 
					1,
					$Course->getPrice1(),
					1
				);
				$mSD->insert($SD);								
			}else{
				$SD = $mSD->find($IdSD);
				/*
				$SD = $mSD->find($IdSD);
				
				$Count = $SD->getCount() + $Delta;
				$SD->setCount($Count);
				$mSD->update($SD);
				*/								
			}			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setObject("SD", $SD);
		}
	}
?>