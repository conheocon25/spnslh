<?php
	namespace MVC\Command;	
	class FSearch extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$SearchContent = $request->getProperty('SearchContent');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();						
			$mPost 			= new \MVC\Mapper\Post();
			$mTag 			= new \MVC\Mapper\Tag();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Page)) $Page = 1;
			//$Tag 			= $mTag->findByKey("am-thuc");
			//$PTAll 			= $mPostTag->findByTagPage(array($Tag->getId(), $Page, 6));
			//$PN 			= new \MVC\Domain\PageNavigation($Tag->getPostAll()->count(), 6, $Tag->getURLView());
			$PostAll		= $mPost->searchByTitle(array($SearchContent));
			echo "KQ ".$PostAll->count();
			
			$TagAll 		= $mTag->findAll();
			
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty("Page", 				$Page);
			$request->setProperty("SearchContent", 		$SearchContent);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("PostAll", 				$PostAll);
			//$request->setObject("PN", 					$PN);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>