<?php
	namespace MVC\Command;	
	class AGetListRss extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mRss = new \MVC\Mapper\RssLink();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$RssAll 	= $mRss->findAll();	
			$StrListRss = "";
			
			while ($RssAll->valid()){
				$dRss = $RssAll->current();
					$StrListRss .= $dRss->getId() . ",";							
				$RssAll->next();
			}
			
			echo $StrListRss;
			
		}
	}
?>