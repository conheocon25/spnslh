<?php		
	namespace MVC\Command;	
	class ASelling extends Command {
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
			$mCategory 	= new \MVC\Mapper\Category();			
			$mConfig	= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryAll 	= $mCategory->findAll();						
			$ConfigCategoryAuto		= $mConfig->findByName("CATEGORY_AUTO");
			$ConfigSwitchBoardCall	= $mConfig->findByName("SWITCH_BOARD_CALL");
			$ConfigName				= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title 		= "BÁN HÀNG";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'				, $Title);
			$request->setObject('Navigation'			, $Navigation);						
			$request->setObject('CategoryAll'			, $CategoryAll);			
			$request->setObject('ConfigCategoryAuto'	, $ConfigCategoryAuto);
			$request->setObject('ConfigName'			, $ConfigName);
			$request->setObject('ConfigSwitchBoardCall'	, $ConfigSwitchBoardCall);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>