<?php		
	namespace MVC\Command;	
	class SalePriceBranch extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdBranch = $request->getProperty('IdBranch');
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mBranch 	= new \MVC\Mapper\Branch();
																		
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																											
			$BranchAll 	= $mBranch->findAll();
			$Branch 	= $mBranch->find($IdBranch);
			
			$Title 		= $Branch->getName();
			$Navigation = array(
				array("BÁN HÀNG", "/ql-ban-hang"),
				array("GIÁ BÁN", "/ql-ban-hang/gia-ban")
			);			
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title"	, 	$Title);
			$request->setObject("Navigation", 	$Navigation);
			
			$request->setObject("BranchAll", 	$BranchAll);
			$request->setObject("Branch", 		$Branch);
																	
			return self::statuses('CMD_DEFAULT');
		}
	}
?>