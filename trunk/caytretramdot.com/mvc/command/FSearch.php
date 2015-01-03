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
			if (!isset($SearchContent)||$SearchContent==null){$SearchContent = $Session->getSearchContent();}
			$Session->setSearchContent($SearchContent);
			
			if (!isset($Page)) $Page = 1;
			$PostAll		= $mPost->searchByTitlePage(array($SearchContent, $Page, 6));
			$PostAll1		= $mPost->searchByTitle(array($SearchContent));
			$PN 			= new \MVC\Domain\PageNavigation($PostAll1->count(), 6, "/bai-viet/tim-kiem");
						
			$TagAll 		= $mTag->findAll();			
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty("Page", 				$Page);
			$request->setProperty("SearchContent", 		$SearchContent);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("PostAll", 				$PostAll);
			$request->setObject("PN", 					$PN);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>