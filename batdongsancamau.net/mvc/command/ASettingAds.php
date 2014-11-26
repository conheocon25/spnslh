<?php		
	namespace MVC\Command;	
	class ASettingAds extends Command {
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
			$mAds 		= new \MVC\Mapper\Ads();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$AdsAll = $mAds->findAll();			
						
			$Title 		= "QUẢNG CÁO";
			$Navigation = array(array("THIẾT LẬP", "/admin/setting"));
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			$AdsAll1 	= $mAds->findByPage(array($Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation($AdsAll->count(), $Config->getValue(), "/setting/ads" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Ads');
			$request->setProperty('Page'		, $Page);			
			$request->setObject('PN'			, $PN);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('AdsAll1'		, $AdsAll1);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>