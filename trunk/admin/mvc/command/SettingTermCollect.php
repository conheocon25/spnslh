<?php		
	namespace MVC\Command;	
	class SettingTermCollect extends Command {
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
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CategoryAll = $mCategory->findAll();
			$DomainAll = $mDomain->findAll();			
			$EmployeeAll = $mEmployee->findAll();
			$UnitAll = $mUnit->findAll();			
			$CustomerAll = $mCustomer->findAll();
			$TermPaidAll = $mTermPaid->findAll();
			$TermCollectAll = $mTermCollect->findAll();			
			$UserAll = $mUser->findAll();
			$ConfigAll = $mConfig->findAll();
			
			$Title = "DANH MỤC THU";
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("THIẾT LẬP", "/setting")
			);
			
			if (!isset($Page)) $Page=1;
			$Config = $mConfig->findByName("ROW_PER_PAGE");
			$TermCollectAll1 = $mTermCollect->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($TermCollectAll->count(), $Config->getValue(), "/setting/termcollect" );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', $Title);
			$request->setProperty('ActiveAdmin', 'TermCollect');
			$request->setProperty('Page', $Page);
			$request->setObject('PN', $PN);
			$request->setObject('Navigation', $Navigation);
			$request->setObject('TermCollectAll1', $TermCollectAll1);
			
			$request->setObject('CategoryAll', $CategoryAll);			
			$request->setObject('DomainAll', $DomainAll);			
			$request->setObject('EmployeeAll', $EmployeeAll);
			$request->setObject('UnitAll', $UnitAll);			
			$request->setObject('CustomerAll', $CustomerAll);
			$request->setObject('TermPaidAll', $TermPaidAll);
			$request->setObject('TermCollectAll', $TermCollectAll);
			$request->setObject('UserAll', $UserAll);
			$request->setObject('ConfigAll', $ConfigAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>