<?php		
	namespace MVC\Command;	
	class ASettingCategory1 extends Command {
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
			$mCategory 		= new \MVC\Mapper\Category();
			$mConfig 		= new \MVC\Mapper\Config();
			$mGAttribute	= new \MVC\Mapper\GAttribute();
			$mPresentation	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryAll 		= $mCategory->findAll();			
			$Category 			= $mCategory->find($IdCategory);
			$PresentationAll 	= $mPresentation->findAll();
			
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 	"/admin/setting"),
				array("DANH MỤC", 	"/admin/setting")
			);			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
					
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('Category'			, $Category);
			$request->setObject('CategoryAll'		, $CategoryAll);
			$request->setObject('PresentationAll'	, $PresentationAll);
			$request->setObject('ConfigName'		, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>