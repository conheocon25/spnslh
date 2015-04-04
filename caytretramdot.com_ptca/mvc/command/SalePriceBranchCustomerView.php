<?php		
	namespace MVC\Command;	
	class SalePriceBranchCustomerView extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdBranch 	= $request->getProperty('IdBranch');
			$IdCustomer = $request->getProperty('IdCustomer');
			$IdCP 		= $request->getProperty('IdCP');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mBranch 	= new \MVC\Mapper\Branch();
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mCP 		= new \MVC\Mapper\CustomerPrice();
			$mCPD 		= new \MVC\Mapper\CustomerPriceDetail();
			$mGood 		= new \MVC\Mapper\Good();
																		
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$GoodAll 	= $mGood->findAll();
			$Branch 	= $mBranch->find($IdBranch);
			$Customer 	= $mCustomer->find($IdCustomer);
			$CP 		= $mCP->find($IdCP);
			
			if ($CP->getDetailAll()->count()==0){
				while ($GoodAll->valid()){
					$Good = $GoodAll->current();					
					$CPD = new \MVC\Domain\CustomerPriceDetail(
						null,
						$CP->getId(),
						$Good->getId(),
						0,
						0
					);
					$mCPD->insert($CPD);				
					$GoodAll->next();
				}				
			}
			
			$Title 		= "BẢNG GIÁ ".$CP->getDateTimePrint();
			$Navigation = array(
				array("BÁN HÀNG"		, 	"/ql-ban-hang"),
				array("GIÁ BÁN"			, 	"/ql-ban-hang/gia-ban"),
				array($Branch->getName(), 	$Branch->getURLPrice()),
				array(mb_strtoupper($Customer->getName(), 'UTF8'), $Customer->getURLPrice())
			);			
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title"	, 	$Title);
			$request->setObject("Navigation", 	$Navigation);
			$request->setObject("Branch", 		$Branch);
			$request->setObject("Customer", 	$Customer);
			$request->setObject("CP", 			$CP);
																	
			return self::statuses('CMD_DEFAULT');
		}
	}
?>