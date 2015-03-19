<?php
	namespace MVC\Command;	
	class ASettingDepartment extends Command {
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
			$mDepartment 	= new \MVC\Mapper\Department();
			$mConfig 		= new \MVC\Mapper\Config();			
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$DepartmentAll = $mDepartment->findAll();
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$DepartmentAll1 	= $mDepartment->findByPage(array($Page, $Config->getValue() ));
			$PN 				= new \MVC\Domain\PageNavigation($DepartmentAll->count(), $Config->getValue(), "/admin/setting/department");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);									
			$request->setObject('DepartmentAll1'	, $DepartmentAll1);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>