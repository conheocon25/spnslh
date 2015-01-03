<?php		
	namespace MVC\Command;	
	class MoneyPaidEmployee extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdEmployee = $request->getProperty('IdEmployee');
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mPaidEmployee 	= new \MVC\Mapper\PaidEmployee();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$EmployeeAll = $mEmployee->findAll();
			if (isset($IdEmployee)){
				$Employee = $mEmployee->find($IdEmployee);
			}else{
				$Employee = $EmployeeAll->current();
				$IdEmployee = $Employee->getId();
			}						
			$Config 	= $mConfig->findByName('ROW_PER_PAGE');
			$ConfigName = $mConfig->findByName('NAME');
			
			if (!isset($Page)) $Page = 1;
			$PaidAll = $mPaidEmployee->findByPage(array($IdEmployee, $Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation( $Employee->getPaidAll()->count(), $Config->getValue(), $Employee->getURLPaid());
			
			$Title = $Employee->getName()." > ỨNG LƯƠNG";
			$Navigation = array(
				array("THU / CHI", "/money")			
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject('Employee'		, $Employee);
			$request->setObject('EmployeeAll'	, $EmployeeAll);
			$request->setObject('PaidAll'		, $PaidAll);
			$request->setObject('PN'			, $PN);
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setProperty('Page'		, $Page);
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
		}
	}
?>