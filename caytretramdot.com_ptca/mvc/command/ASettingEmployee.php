<?php
	namespace MVC\Command;	
	class ASettingEmployee extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDepartment	= $request->getProperty('IdDepartment');
			$Page 			= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mDepartment 	= new \MVC\Mapper\Department();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$DepartmentAll	= $mDepartment->findAll();
			$Department		= $mDepartment->find($IdDepartment);
			$EmployeeAll 	= $mEmployee->findByDepartment(array($IdDepartment));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$EmployeeAll1 	= $mEmployee->findByDepartmentPage(array($IdDepartment, $Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($EmployeeAll->count(), $Config->getValue(), "/admin/setting/employee");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('Department'	, $Department);
			$request->setObject('DepartmentAll'	, $DepartmentAll);
			$request->setObject('EmployeeAll1'	, $EmployeeAll1);
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>