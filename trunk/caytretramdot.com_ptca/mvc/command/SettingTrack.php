<?php
	namespace MVC\Command;	
	class SettingTrack extends Command {
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
			$mTrack 	= new \MVC\Mapper\Track();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TrackAll = $mTrack->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$TrackAll1 	= $mTrack->findByPage(array($Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation($TrackAll->count(), $Config->getValue(), "/admin/setting/track");
			
			$Title = "BÁO CÁO";
			$Navigation = array(array("THIẾT LẬP", "/admin"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'			, $Page);
			$request->setObject('PN'				, $PN);
			$request->setObject('TrackAll1'			, $TrackAll1);
			$request->setProperty('Title'			, $Title);
			$request->setObject('Navigation'		, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>