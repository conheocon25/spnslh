<?php
	namespace MVC\Command;	
	class SettingProjectInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Name			= $request->getProperty('Name');
			$Address		= $request->getProperty('Address');
			$Type1			= $request->getProperty('Type1');
			$Investors		= $request->getProperty('Investors');
			$Stretch		= $request->getProperty('Stretch');
			$Payment		= $request->getProperty('Payment');
			$DateStart		= $request->getProperty('DateStart');
			$DateEnd		= $request->getProperty('DateEnd');
			$Type			= $request->getProperty('Type');
			$Description	= \stripslashes($request->getProperty('Description'));
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mProject		= new \MVC\Mapper\Project();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if ($Type=="on")
				$Type=1;
			else
				$Type=0;

			$Project = new \MVC\Domain\Project(			
				null,
				$Name,
				$Description,
				$Address,
				$Type1,
				$Investors,
				$Stretch,
				$Payment,
				$DateStart,
				$DateEnd,
				$Type,
				null
			);
			$Project->reKey();
			$mProject->insert($Project);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
