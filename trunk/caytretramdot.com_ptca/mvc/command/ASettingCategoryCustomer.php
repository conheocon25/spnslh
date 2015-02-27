<?php
	namespace MVC\Command;	
	class ASettingCategoryCustomer extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryCustomer 	= new \MVC\Mapper\CategoryCustomer();
			$mConfig 	= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$CategoryCustomerAll = $mCategoryCustomer->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$CategoryCustomerAll1 	= $mCategoryCustomer->findByPage(array($Page, $Config->getValue() ));
			$PN 		= new \MVC\Domain\PageNavigation($CategoryCustomerAll->count(), $Config->getValue(), "/setting/CategoryCustomer");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);									
			$request->setObject('CategoryCustomerAll1'	, $CategoryCustomerAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>