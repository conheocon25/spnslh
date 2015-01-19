<?php		
	namespace MVC\Command;	
	class ABoard extends Command {
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
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Title = "VÁN CỜ";
			$Navigation = array();
						
			$ConfigName = $mConfig->findByName("NAME");
						
			$CategoryBoardAll = $mCategoryBoard->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('CategoryBoardAll'	, $CategoryBoardAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>