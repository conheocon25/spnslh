<?php		
	namespace MVC\Command;	
	class ASavingDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSave = $request->getProperty('IdSave');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSave 		= new \MVC\Mapper\Save();
			$mConfig 	= new \MVC\Mapper\Config();
			$mProduct 	= new \MVC\Mapper\Product();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ProductAll= $mProduct->findAll();
			$SaveAll 	= $mSave->findAll();
			$Save 		= $mSave->find($IdSave);
			
			$Title = mb_strtoupper($Save->getName(), 'UTF8');
			$Navigation = array(
				array("KHUYẾN MÃI", 	"/admin/saving")
			);						
			$ConfigName = $mConfig->findByName("NAME");
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Saving');
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ProductAll'	, $ProductAll);
			$request->setObject('SaveAll'		, $SaveAll);
			$request->setObject('Save'			, $Save);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>