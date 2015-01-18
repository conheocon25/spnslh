<?php		
	namespace MVC\Command;	
	class ARestaurant extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mProvince 	= new \MVC\Mapper\Province();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Title = "TỈNH THÀNH";
			$Navigation = array();
						
			$ConfigName = $mConfig->findByName("NAME");
						
			$ProvinceAll = $mProvince->findAll(array());
			$Province 	 = $ProvinceAll->current();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('ProvinceAll'	, $ProvinceAll);
			$request->setObject('Province'		, $Province);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>