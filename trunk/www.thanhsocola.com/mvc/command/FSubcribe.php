<?php
	namespace MVC\Command;	
	class FSubcribe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Email = $request->getProperty('Email');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mFeed 		= new \MVC\Mapper\Feed();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Feed = $mFeed->findByEmail($Email);
			if (!isset($Feed) || $Feed==null){
				$Feed = new \MVC\Domain\Feed(
					null,
					$Email
				);
				$mFeed->insert($Feed);
			}
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			return self::statuses('CMD_OK');
		}
	}
?>