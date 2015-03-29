<?php		
	namespace MVC\Command;	
	class BranchSaleCommandQuota extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey = $request->getProperty('IdKey');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mBranchQuota 	= new \MVC\Mapper\BranchQuota();
			$mCommand 		= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch		= $mBranch->findByKey($IdKey);
			$CommandAll = $mCommand->findByBranchDateState(array($Branch->getId(), \date("Y-m-d"), 2));
			
			//Phát sinh bộ dữ liệu QUOTA
			while($CommandAll->valid()){
				$Command = $CommandAll->current();
				$CDAll = $Command->getDetailAll();
				while ($CDAll->valid()){
					$CD = $CDAll->current();
					
					$BQ = $mBranchQuota->check(array($Branch->getId(),\date("Y-m-d"),$CD->getIdGood()));
					if ($BQ == null){
						$BQ = new \MVC\Domain\BranchQuota(
							null,
							$Branch->getId(),
							\date("Y-m-d"),
							$CD->getIdGood(),
							$CD->getCount1(),
							$CD->getCount2()
						);
						$mBranchQuota->insert($BQ);
					}else{
						$Count1 = $BQ->getCount1() + $CD->getCount1();
						$Count2 = $BQ->getCount2() + $CD->getCount2();
						
						$BQ->setCount1($Count1);
						$BQ->setCount2($Count2);
						
						$mBranchQuota->update($BQ);
					}														
					$CDAll->next();
				}
				//Xác nhận đã cập nhật vào Quota
				$Command->setState(3);
				$mCommand->update($Command);
				
				$CommandAll->next();
			}			
			$BranchQuotaAll = $mBranchQuota->findByBranchDate(array($Branch->getId(), \date("Y-m-d")));
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Branch", $Branch);
			$request->setObject("BranchQuotaAll", $BranchQuotaAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>