<?php		
	namespace MVC\Command;	
	class ReportInfo extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 	= new \MVC\Mapper\Config();
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mCategory 	= new \MVC\Mapper\Category();
			$mCourse 	= new \MVC\Mapper\Course();
			$mOrder 	= new \MVC\Mapper\OrderImport();
			$mOD 		= new \MVC\Mapper\OrderImportDetail();
			$mSession 	= new \MVC\Mapper\Session();
			$mSD 		= new \MVC\Mapper\SessionDetail();
			$mTableLog 	= new \MVC\Mapper\TableLog();
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mResource 	= new \MVC\Mapper\Resource();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$DomainAll 	= $mDomain->findAll();
			$TableAll 	= $mTable->findAll();
			$CategoryAll= $mCategory->findAll();
			$CourseAll	= $mCourse->findAll();
			$SessionAll	= $mSession->findAll();
			$SDAll		= $mSD->findAll();
			$LogAll		= $mTableLog->findAll();
			$OrderAll	= $mOrder->findAll();
			$ODAll		= $mOD->findAll();
			$SupplierAll= $mSupplier->findAll();
			$ResourceAll= $mResource->findAll();
			
			$Title 		= "BÁO CÁO";
			$Navigation = array();
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title'		, $Title);						
			$request->setProperty('ActiveAdmin'	, 'Report');
			$request->setObject('Navigation'	, $Navigation);						
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('DomainAll'		, $DomainAll);
			$request->setObject('TableAll'		, $TableAll);
			$request->setObject('CategoryAll'	, $CategoryAll);
			$request->setObject('CourseAll'		, $CourseAll);
			$request->setObject('SessionAll'	, $SessionAll);
			$request->setObject('SDAll'			, $SDAll);
			$request->setObject('LogAll'		, $LogAll);
			$request->setObject('OrderAll'		, $OrderAll);
			$request->setObject('ODAll'			, $ODAll);
			$request->setObject('SupplierAll'	, $SupplierAll);
			$request->setObject('ResourceAll'	, $ResourceAll);
		}
	}
?>