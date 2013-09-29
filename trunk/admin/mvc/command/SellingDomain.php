<?php
	namespace MVC\Command;
	class SellingDomain extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty('IdDomain');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mDomain = new \MVC\Mapper\Domain();
			$mTable = new \MVC\Mapper\Table();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$DomainAll = $mDomain->findAll();
			$Domain = $mDomain->find($IdDomain);
			if (!isset($Domain)){
				$Domain = $DomainAll->current();
				$IdDomain = $Domain->getId();
			}
			
			$Title = $Domain->getName();
			$Navigation = array(
				array("Bán Hàng", "/selling")				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setObject("Domain", $Domain);
			$request->setObject("DomainAll", $DomainAll);
			$request->setProperty("Title", $Title);
			$request->setObject("Navigation", $Navigation);
		}
	}
?>
