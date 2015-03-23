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
			$IdGroup 	= $request->getProperty('IdGroup');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 			= new \MVC\Mapper\Customer();
			$mCustomerGroup 	= new \MVC\Mapper\CustomerGroup();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Group			= $mCustomerGroup->find($IdGroup);
			$GroupAll		= $mCustomerGroup->findAll();
			$CustomerAll 	= $mCustomer->findByGroup(array($IdGroup));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName		= $mConfig->findByName("NAME");			
			$CustomerAll1 	= $mCustomer->findByGroupPage(array($IdGroup, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($CustomerAll->count(), $Config->getValue(), "/admin/setting/customer");
			
			$Title = mb_strtoupper($Group->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin"),
				array("NHÓM KHÁCH HÀNG", "/admin/setting/customer")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Group'			, $Group);
			$request->setObject('GroupAll'		, $GroupAll);
			$request->setObject('CustomerAll1'	, $CustomerAll1);
																					
			return self::statuses('CMD_DEFAULT');
		}
	}
?>