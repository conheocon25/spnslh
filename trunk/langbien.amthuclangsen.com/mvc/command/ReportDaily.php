<?php		
	namespace MVC\Command;	
	class ReportDaily extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack 	= $request->getProperty('IdTrack');
			$IdTD 		= $request->getProperty('IdTD');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mTC 		= new \MVC\Mapper\TrackingCourse();
			$mTS 		= new \MVC\Mapper\TrackingStore();
			$mSession 	= new \MVC\Mapper\Session();
			$mOrder 	= new \MVC\Mapper\OrderImport();
			$mSD 		= new \MVC\Mapper\SessionDetail();
			$mR2C  		= new \MVC\Mapper\R2C();
			$mResource 	= new \MVC\Mapper\Resource();
			$mCourse 	= new \MVC\Mapper\Course();
			$mPaid 		= new \MVC\Mapper\PaidGeneral();
			$mCollect	= new \MVC\Mapper\CollectGeneral();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			
			//(1) TÍNH BÁO CÁO BÁN HÀNG
			$SessionAll = $mSession->findByTracking( array(
				$TD->getDate()." 0:0:0", 
				$TD->getDate()." 23:59:59"
			));			
			$ValueSelling 		= 0;
			while ($SessionAll->valid()){
				$Session 		= $SessionAll->current();
				$ValueSelling 	+= $Session->getValue();
				$SessionAll->next();
			}
			
			//(2) TÍNH BÁO CÁO NHẬP HÀNG
			$OrderAll = $mOrder->findByTracking( array(
				$TD->getDate(), 
				$TD->getDate()
			));			
			$ValueImport 		= 0;
			while ($OrderAll->valid()){
				$Order 			= $OrderAll->current();
				$ValueImport 	+= $Order->getValue();
				$OrderAll->next();
			}			
			
			//(3) TÍNH BÁO CÁO CHI TIỀN
			$PaidAll = $mPaid->findByTracking( array(
				$TD->getDate(), 
				$TD->getDate()
			));			
			$ValuePaid 		= 0;
			while ($PaidAll->valid()){
				$Paid 		= $PaidAll->current();
				$ValuePaid 	+= $Paid->getValue();
				$PaidAll->next();
			}
			
			//(4) TÍNH BÁO CÁO THU TIỀN
			$CollectAll = $mCollect->findByTracking( array(
				$TD->getDate(), 
				$TD->getDate()
			));			
			$ValueCollect = 0;
			while ($CollectAll->valid()){
				$Collect 		= $CollectAll->current();
				$ValueCollect 	+= $Collect->getValue();
				$CollectAll->next();
			}
			
			//(5) TÍNH BÁO CÁO TỒN KHO
			$ResourceAll 	= $mResource->findAll();						
			$mTS->deleteByTracking(array($IdTrack, $IdTD));
			
			while ($ResourceAll->valid()){
				$Resource = $ResourceAll->current();				
				
				//Tính phần nhập hàng
				$R2CAll = $mR2C->findByResource(array($Resource->getId()));
												
				//Nếu có trong bảng ánh xạ mới tính toán
				if ($R2CAll->count()>0){
					
					//Tính số lượng hàng nhập trong kì
					$CountImport = $TD->getImportCount( $Resource->getId() );
					
					//Tính số lượng hàng nhập xuất kho bán trong kì
					$R2CAll->rewind();
					$CountExport = 0;
					while ($R2CAll->valid()){
						$R2C = $R2CAll->current();
						$IdCourse = $R2C->getIdCourse();
						$CountExport += round(($TD->getExportCount( $IdCourse ))*$R2C->getValue1()/$R2C->getValue2(),1);
						$R2CAll->next();
					}
					
					//Tính toán tồn cũ còn trước đó
					$TSAllPre = $mTS->findByPre(array($IdTD, $Resource->getId()));
					if ($TSAllPre->count()==0){
						$CountOld = 0;
					}else{
						$CountOld = $TSAllPre->current()->getCountRemain();
					}
					
					$TS = new \MVC\Domain\TrackingStore(
						null,
						$IdTrack,
						$IdTD,
						$Resource->getId(), 
						$CountOld,
						$CountImport, 
						$CountExport,
						$Resource->getPrice()
					);
					$mTS->insert($TS);																				
										
				}
				$ResourceAll->next();
			}						
			$TSAll = $mTS->findByDaily(array($IdTrack, $IdTD));
			
			$ValueStore = 0;
			while ($TSAll->valid()){
				$TS = $TSAll->current();
				$ValueStore += $TS->getCountRemainValue();
				$TSAll->next();
			}
			
			//(6) THỐNG KÊ MÓN THEO NGÀY			
			$CourseAll	= $mCourse->findAll();						
			$mTC->deleteByTracking(array($IdTrack, $IdTD));
			
			while ($CourseAll->valid()){
				$Course = $CourseAll->current();
				$Count	= $mSD->trackByCount(array(
					$Course->getId(),
					$TD->getDate()." 0:0:0",
					$TD->getDate()." 23:59:59"
				));
				if (isset($Count)){
					$TC = new \MVC\Domain\TrackingCourse(
						null,
						$IdTrack,
						$IdTD,
						$Course->getId(),
						$Count,
						0,
						0
					);
					$mTC->insert($TC);
				}
				$CourseAll->next();
			}
						
			//(7) CẬP NHẬT KẾT QUẢ DB DAILY			
			$TD->setSelling($ValueSelling);
			$TD->setImport($ValueImport);
			$TD->setPaid($ValuePaid);
			$TD->setCollect($ValueCollect);
			$TD->setStore($ValueStore);
			$mTD->update($TD);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>