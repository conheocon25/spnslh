<?php		
	namespace MVC\Command;	
	class ASettingAttribute extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdGAttribute 	= $request->getProperty('IdGAttribute');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mGAttribute 	= new \MVC\Mapper\GAttribute();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$GAttribute 	= $mGAttribute->find($IdGAttribute);
			$GAttributeAll 	= $mGAttribute->findAll();
						
			$Title = mb_strtoupper($GAttribute->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 		"/admin/setting"),
				array("DANH MỤC MÔ TẢ", "/admin/setting/gattribute")
			);			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'GAttribute');				
			$request->setObject('Navigation'		, $Navigation);
			$request->setObject('GAttribute'		, $GAttribute);
			$request->setObject('GAttributeAll'		, $GAttributeAll);
			$request->setObject('ConfigName'		, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>