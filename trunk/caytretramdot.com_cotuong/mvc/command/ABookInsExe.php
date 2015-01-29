<?php
	namespace MVC\Command;	
	class ABookInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdBook 	= $request->getProperty('IdBook');
			$IdCategory = $request->getProperty('IdCategory');									
			$Title 		= $request->getProperty('Title');			
			$Time 		= $request->getProperty('Time');			
			$Info 		= \stripslashes($request->getProperty('Info'));
			$Author 	= $request->getProperty('Author');
			$Language	= $request->getProperty('Language');
			$Order		= $request->getProperty('Order');
			$URL		= $request->getProperty('URL');
			$Viewed		= $request->getProperty('Viewed');
			$Liked		= $request->getProperty('Liked');
			$Thumb		= $request->getProperty('Thumb');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBook = new \MVC\Mapper\Book();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Book = new \MVC\Domain\Book(
				null, 
				$IdCategory, 
				$Title, 
				$Time, 
				$Info, 
				$Author, 
				$Language, 
				$Order, 
				$URL,
				$Viewed,
				$Liked,
				$Thumb, 
				"");
			$Book->reKey();
			
			$mBook->insert($Book);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>