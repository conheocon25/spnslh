<?php		
	namespace MVC\Command;	
	class ABoardPose extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$IdBoard 	= $request->getProperty('IdBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mBoard 			= new \MVC\Mapper\Board();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Title = "VÁN CỜ";
			$Navigation = array();
						
			$ConfigName = $mConfig->findByName("NAME");
			
			$Category 			= $mCategoryBoard->find($IdCategory);
			$Board				= $mBoard->find($IdBoard);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('Category'		, $Category);
			$request->setObject('Board'			, $Board);
																					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>