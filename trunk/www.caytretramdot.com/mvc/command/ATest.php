<?php		
	namespace MVC\Command;	
	class ATest extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 	= new \MVC\Mapper\Config();
			$mExam 		= new \MVC\Mapper\Exam();
			$mTest 		= new \MVC\Mapper\Test();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
						
			$Title = "KIỂM TRA";
			$Navigation = array();
			
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");

			$ExamAll		= $mExam->findAll();	
			$TestAll 		= $mTest->findAll();
			$TestAll1 		= $mTest->findByPage(array($Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($TestAll->count(), $Config->getValue(), "/setting/Test" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Test');
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ExamAll'		, $ExamAll);
			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('TestAll1'		, $TestAll1);
			$request->setObject('TestAll'		, $TestAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>