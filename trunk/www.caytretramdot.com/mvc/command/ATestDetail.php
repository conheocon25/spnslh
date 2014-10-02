<?php		
	namespace MVC\Command;	
	class ATestDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Page 		= $request->getProperty('Page');
			$IdTest 	= $request->getProperty('IdTest');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 	= new \MVC\Mapper\Config();
			$mExam 		= new \MVC\Mapper\Exam();
			$mTest 		= new \MVC\Mapper\Test();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Test 			= $mTest->find($IdTest);
			$TDAll			= $Test->getDetailAll();
			if ($TDAll->count()==0){
				
			}
									
			$Title = mb_strtoupper($Test->getExam()->getName(), 'UTF8');
			$Navigation = array(
				array("KIỂM TRA", "/admin/test"),
			);
						
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Test');
			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Test'			, $Test);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>