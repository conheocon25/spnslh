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
			$IdCategory = $request->getProperty('IdCategory');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCBM 			= new \MVC\Mapper\CBM();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$CategoryBoardAll	= $mCategoryBoard->findAll();
			if (!isset($IdCategory)){
				$IdCategory = $CategoryBoardAll->current()->getId();
			}
			$Category	= $mCategoryBoard->find($IdCategory);
			$CBMAll 	= $mCBM->findBy(array($IdCategory));
			
			$Title 		= mb_strtoupper($Category->getName(), 'UTF8')." / VÁN CỜ";
			$Navigation = array();
			$ConfigName = $mConfig->findByName("NAME");				
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('CategoryBoardAll'	, $CategoryBoardAll);
			$request->setObject('Category'			, $Category);
			$request->setObject('BoardAll'			, $CBMAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>