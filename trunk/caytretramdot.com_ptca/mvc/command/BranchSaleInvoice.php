<?php		
	namespace MVC\Command;	
	class BranchSaleInvoice extends Command {
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
			$mBranchQuota	= new \MVC\Mapper\BranchQuota();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Branch			= $mBranch->findByKey($IdKey);
			$ConfigTimer	= $mConfig->findByName("TIMER_01");
			
			//$BranchQuotaAll = $mBranchQuota->findByBranchDate(array($Branch->getId(), \date("Y-m-d")));
			
			$Title = "BÁN HÀNG";
			$Navigation = array(
				array(mb_strtoupper($Branch->getName(), 'UTF8'), "/don-vi/".$Branch->getKey())
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Branch"		, $Branch);
			//$request->setObject("BranchQuotaAll", $BranchQuotaAll);
			$request->setObject("ConfigTimer"	, $ConfigTimer);
			
			$request->setObject("Navigation"	, $Navigation);				
			$request->setProperty("Title"		, $Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>