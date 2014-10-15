<?php
	namespace MVC\Command;	
	class FBookmarkAdd extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Data = $request->getProperty('Data');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Cart = $Session->getBookmark();
			$Cart->addItem(
				$Data[0],
				array(
					"Id"	=> $Data[0],
					"Name"	=> $Data[1],
					"Price"	=> $Data[2],
					"Image"	=> $Data[3]
				)
			);								
			$Session->setBookmark($Cart);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			return self::statuses('CMD_OK');
		}
	}
?>