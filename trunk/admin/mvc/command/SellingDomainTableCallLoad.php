<?php
	namespace MVC\Command;
	class SellingDomainTableCallLoad extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty("IdDomain");
			$IdTable = $request->getProperty("IdTable");
			$IdCategory = $request->getProperty("IdCategory");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategory = new \MVC\Mapper\Category();
			$mCourse = new \MVC\Mapper\Course();
			$mTable = new \MVC\Mapper\Table();
			$mSession = new \MVC\Mapper\Session();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$CategoryAll = $mCategory->findAll();
			if (!isset($IdCategory))
				$Category = $CategoryAll->current();
			else
				$Category = $mCategory->find($IdCategory);
						
			$Table = $mTable->find($IdTable);			
			$Domain = $Table->getDomain();
			$URLCallLoad = $Table->getURLCallLoad();
			$URLCall = $Table->getURLCallExe();
						
			$Title = mb_strtoupper($Table->getName(), 'UTF8');
			$Navigation = array(
				array("ỨNG DỤNG", "/app"),
				array("BÁN HÀNG", "/selling"),
				array(mb_strtoupper($Domain->getName(), 'UTF8'), $Domain->getURLSelling())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("URLCall", $URLCall);
			$request->setProperty("URLCallLoad", $URLCallLoad);
			$request->setProperty("Title", $Title);
			$request->setObject("Navigation", $Navigation);
			$request->setObject("Category", $Category);
			$request->setObject("CategoryAll", $CategoryAll);			
			$request->setObject('Table', $Table);
		}
	}
?>
