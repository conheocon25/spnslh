<?php		
	namespace MVC\Command;	
	class SettingSolveClause extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain 	= $request->getProperty('IdDomain');
			$IdSolve 	= $request->getProperty('IdSolve');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 	= new \MVC\Mapper\Config();
			$mDomain 	= new \MVC\Mapper\Domain();
			$mSolve 	= new \MVC\Mapper\Solve();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Domain 	= $mDomain->find($IdDomain);
			$Solve 		= $mSolve->find($IdSolve);
			
			$Title = mb_strtoupper($Solve->getName(), 'UTF8');
			
			$Navigation = array(
					array("THIẾT LẬP", 									"/setting"),
					array("LĨNH VỰC", 									"/setting/domain"),
					array(mb_strtoupper($Domain->getName(), 'UTF8'), 	$Domain->getURLSettingSolve())
			);			
			$ConfigName = $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Domain'		, $Domain);			
			$request->setObject('Solve'			, $Solve);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>