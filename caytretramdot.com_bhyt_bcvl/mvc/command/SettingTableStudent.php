<?php
	namespace MVC\Command;	
	class SettingTableStudent extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdDomain 	= $request->getProperty("IdDomain");
			$IdTable 	= $request->getProperty("IdTable");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Domain 	= $mDomain->find($IdDomain);
			$Table 		= $mTable->find($IdTable);
			$TableAll	= $mTable->findAll();
			
			$Title = mb_strtoupper($Table->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/setting"),
				array("KHỐI", "/setting/domain"),
			);						
			$ConfigName = $mConfig->findByName("NAME");
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Domain"	, $Domain);
			$request->setObject("Table"		, $Table);
			$request->setObject("TableAll"	, $TableAll);
			$request->setObject("ConfigName", $ConfigName);
			
			$request->setProperty("Title"	, $Title);			
			$request->setObject("Navigation", $Navigation);			
		}
	}
?>