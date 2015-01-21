<?php		
	namespace MVC\Command;	
	class ABoardInsLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mBoard 		= new \MVC\Mapper\Board();
			$mConfig		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Category 	= $mCategoryBoard->find($IdCategory);
			
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(				
				array("VÀN CỜ", 	"/admin/board"),	
			);
			
			$ConfigName	= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Board');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Category'		, $Category);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>