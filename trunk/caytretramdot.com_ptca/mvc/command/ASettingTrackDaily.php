<?php
	namespace MVC\Command;	
	class ASettingTrackDaily extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack = $request->getProperty('IdTrack');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTrack 	= new \MVC\Mapper\Track();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TrackAll 	= $mTrack->findAll();
			$Track 		= $mTrack->find($IdTrack);
			if ($Track->getDetailAll()->count()==0)
				$Track->generateDaily();
			
			$Title = mb_strtoupper($Track->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin"),
				array("BÁO CÁO", "/admin/setting/track")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('TrackAll'	, $TrackAll);
			$request->setObject('Track'		, $Track);
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>