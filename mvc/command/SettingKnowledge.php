<?php
	namespace MVC\Command;	
	class SettingKnowledge extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mNewsKnowledge = new \MVC\Mapper\NewsKnowledge();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryKnowledgeAll = $mCategoryKnowledge->findAll();
						
			$Category = $mCategoryKnowledge->find($IdCategory);
			$Title = mb_strtoupper("THIẾT LẬP / KIẾN THỨC / ".$Category->getName(), 'UTF8');
			$URLBack = "/setting/category/knowledge";
			
			if (!isset($Page)) $Page=1;
			$News = $mNewsKnowledge->findByCategoryPage(array($IdCategory, $Page, 9));
			$PN = new \MVC\Domain\PageNavigation($Category->getNews()->count(), 8, $Category->getURLView());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("CategoryKnowledgeAll", $CategoryKnowledgeAll);						
			$request->setObject("Category", $Category);
			$request->setObject("News", $News);
			$request->setObject("PN", $PN);
			
			$request->setProperty("Title", $Title);
			$request->setProperty("Page", $Page);
			$request->setProperty("URLBack", $URLBack);
			$request->setProperty("ActiveSetting", 'CategoryKnowledge');
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>