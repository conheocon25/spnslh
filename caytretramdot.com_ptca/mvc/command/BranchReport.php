<?php		
	namespace MVC\Command;	
	class BranchReport extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey = $request->getProperty('IdKey');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mTrack 		= new \MVC\Mapper\Track();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$TrackAll	= $mTrack->findAll();
			
			$Branch		= $mBranch->findByKey($IdKey);
			$Title 		= "BÁO CÁO";
			$Navigation = array(
				array(mb_strtoupper($Branch->getName(), 'UTF8'), "/don-vi/".$Branch->getKey())
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);
			
			$request->setObject("Branch"	, $Branch);
			$request->setObject("TrackAll"	, $TrackAll);			
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>