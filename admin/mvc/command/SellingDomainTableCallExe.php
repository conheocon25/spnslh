<?php
	namespace MVC\Command;
	class SellingDomainTableCallExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session_Sys = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTable = $request->getProperty("IdTable");
			$IdCourse = $request->getProperty("IdCourse");
			$Count = $request->getProperty("Count");
			$Price = $request->getProperty("Price");
			$Delta = $request->getProperty("Delta");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTable = new \MVC\Mapper\Table();
			$mCategory = new \MVC\Mapper\Category();
			$mCourse = new \MVC\Mapper\Course();
			$mSession = new \MVC\Mapper\Session();
			$mSD = new \MVC\Mapper\SessionDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Table = $mTable->find($IdTable);
			$Course = $mCourse->find($IdCourse);
			
			$flag = false;
			if (!isset($Count)){
				$flag = true;
				$Count = 1;
				$Price = $Course->getPrice1();
			}
						
			//Nếu chưa có Session thì tạo
			$Session = $Table->getSessionActive();			
			if (!isset($Session)){
				$Session = new \MVC\Domain\Session(
					null,					//Id
					$IdTable,				//IdTable
					1,						//IdUser
					1,						//IdCustomer	
					\date("Y-m-d H:i:s"), 	//DateTime
					null, 					//DateTimeEnd
					"",						//Note
					"",						//Status
					0,						//Discount	
					0						//Surtax
				);
				$IdSession = $mSession->insert($Session);
			}
			$IdSession = $Session->getId();
						
			//Kiểm tra xem IdCourse đã có tồn tại trong Session hiện tại chưa
			$IdSD = $mSD->check(array($IdSession, $IdCourse));
			if (!isset($IdSD) || $IdSD==null){
				$SD = new \MVC\Domain\SessionDetail(
					null,
					$IdSession, 
					$IdCourse, 
					1,
					$Price
				);
				$mSD->insert($SD);
			}else{
				$SD = $mSD->find($IdSD);
				
				//Thủ thuật dồn 2 lệnh cập nhật lại làm 1
				if ($Count<1){
					$SD->setCount(1);
				}else{
					if ($flag==true){
						$Count = $SD->getCount() + $Delta;
					}
					$SD->setCount($Count);
				}				
				$SD->setPrice($Price);
				$mSD->update($SD);
			}						
			$mSession->update($Session);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setObject("SD", $SD);
		}
	}
?>
