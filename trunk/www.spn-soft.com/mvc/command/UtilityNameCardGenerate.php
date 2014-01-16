<?php
	namespace MVC\Command;	
	class UtilityNameCardGenerate extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$CompanyName 	= $request->getProperty('CompanyName');
			$Slogan			= $request->getProperty('Slogan');
			$FullName		= $request->getProperty('FullName');
			$Position		= $request->getProperty('Position');
			$Phone			= $request->getProperty('Phone');
			$Email			= $request->getProperty('Email');
			$Address		= $request->getProperty('Address');
			$Website		= $request->getProperty('Website');
			$TypeCard		= $request->getProperty('TypeCard');
					
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('TypeCard', $TypeCard);
			$request->setProperty('CompanyName', $CompanyName);
			$request->setProperty('Slogan', $Slogan);
			$request->setProperty('FullName', $FullName);
			$request->setProperty('Position', $Position);
			$request->setProperty('Phone', $Phone);
			$request->setProperty('Email', $Email);
			$request->setProperty('Address', $Address);
			$request->setProperty('Website', $Website);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>