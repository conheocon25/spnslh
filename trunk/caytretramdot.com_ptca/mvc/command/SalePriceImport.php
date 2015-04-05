<?php		
	namespace MVC\Command;	
	class SalePriceImport extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mConfig 	= new \MVC\Mapper\Config();
			$mBranch 	= new \MVC\Mapper\Branch();
																		
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Title 		= "GIÁ NHẬP";
			$Navigation = array(array("BÁN HÀNG", "/ql-ban-hang"));
			$BranchAll 	= $mBranch->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", 	$Navigation);				
			$request->setProperty("Title"	, 	$Title);
			$request->setObject("BranchAll", 	$BranchAll);
																	
			return self::statuses('CMD_DEFAULT');
		}
	}
?>