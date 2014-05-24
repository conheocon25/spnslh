<?php		
	namespace MVC\Command;	
	class ASettingQuestion extends Command {
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
			$mQuestion 	= new \MVC\Mapper\Question();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
						
			$Title = "CÂU HỎI";
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting")				
			);
			
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");
			
			$QuestionAll 	= $mQuestion->findAll();			
			$QuestionAll1 	= $mQuestion->findByPage(array($Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($QuestionAll->count(), $Config->getValue(), "/setting/question" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Question');
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('QuestionAll1'	, $QuestionAll1);
			$request->setObject('QuestionAll'	, $QuestionAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>