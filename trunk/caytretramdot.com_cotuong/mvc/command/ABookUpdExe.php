<?php
	namespace MVC\Command;	
	class ABookUpdExe extends Command{
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
			$Viewed		= $request->getProperty('Viewed');
			$Liked		= $request->getProperty('Liked');
			$Thumb		= $request->getProperty('Thumb');
			$URL		= $request->getProperty('URL');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBook = new \MVC\Mapper\Book();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Book = $mBook->find($IdBook);
			
			$Book->setInfo($Info);			
			$Book->setTitle($Title);
			$Book->setTime($Time);			
			$Book->setAuthor($Author);
			$Book->setLanguage($Language);
			$Book->setOrder($Order);
			$Book->setURL($URL);
			$Book->setViewed($Viewed);
			$Book->setLiked($Liked);
			$Book->setThumb($Thumb);
			$Book->reKey();
			
			$mBook->update($Book);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>