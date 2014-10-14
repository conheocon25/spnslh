<?php		
	namespace MVC\Command;	
	class ASaving extends Command {
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
			$mSave 		= new \MVC\Mapper\Save();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$SaveAll = $mSave->findAll();			
						
			$Title = "KHUYẾN MÃI";
			$Navigation = array();						
			$ConfigName = $mConfig->findByName("NAME");
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Saving');
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('SaveAll'		, $SaveAll);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>