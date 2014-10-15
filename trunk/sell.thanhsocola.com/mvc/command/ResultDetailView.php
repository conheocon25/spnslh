<?php		
	namespace MVC\Command;	
	class ResultDetailView extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack 	= $request->getProperty("IdTrack");
			$IdTD 		= $request->getProperty("IdTD");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$TD 		= $mTD->find($IdTD);
			$LotoAll	= $TD->getLotoAll();
			$ConfigName = $mConfig->findByName("NAME");
			$SMarquee 	= "";
			while ($LotoAll->valid()){
				$Loto = $LotoAll->current();
				$SMarquee .= $ConfigName->getValue(). " KẾT QUẢ XỔ SỐ NGÀY ".$TD->getDatePrint(). $Loto->toString()." - ";
				$LotoAll->next();
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('TD'			, $TD);
			$request->setProperty('ConfigName'	, $ConfigName);
			$request->setProperty('SMarquee'	, $SMarquee);
			$request->setObject('LotoAll'		, $LotoAll);											
		}
	}
?>