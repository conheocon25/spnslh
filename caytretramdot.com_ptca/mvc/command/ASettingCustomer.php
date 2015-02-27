<?php		
	namespace MVC\Command;	
	class ASettingCustomer extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 		= $request->getProperty('Page');
			$IdCategory = $request->getProperty('IdCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mCategoryCustomer 	= new \MVC\Mapper\CategoryCustomer();
			$mConfig 	= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Category		= $mCategoryCustomer->find($IdCategory);
			$CategoryAll	= $mCategoryCustomer->findAll();
			$CustomerAll 	= $mCustomer->findByCategory(array($IdCategory));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");			
			$CustomerAll1 	= $mCustomer->findByCategoryPage(array($IdCategory, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CustomerAll->count(), $Config->getValue(), "/admin/setting/customer");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
						
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Category'		, $Category);
			$request->setObject('CategoryAll'	, $CategoryAll);
			$request->setObject('CustomerAll1'	, $CustomerAll1);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>