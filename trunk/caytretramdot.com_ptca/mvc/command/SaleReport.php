<?php		
	namespace MVC\Command;	
	class SaleReport extends Command{
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
			$mConfig 		= new \MVC\Mapper\Config();
			$mTrack 		= new \MVC\Mapper\Track();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$Title = "BÁO CÁO BÁN HÀNG";
			$Navigation = array();
			
			$TrackAll 	= $mTrack->findAll();
			
			if (!isset($IdTrack)){
				$Track		= $TrackAll->current();
			}else{
				$Track		= $mTrack->find($IdTrack);				
			}
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Track"		, $Track);
			$request->setObject("TrackAll"	, $TrackAll);
			
			$request->setObject("Navigation", $Navigation);				
			$request->setProperty("Title"	, $Title);
																										
			return self::statuses('CMD_DEFAULT');
		}
	}
?>