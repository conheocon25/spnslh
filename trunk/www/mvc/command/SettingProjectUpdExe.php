<?php
	namespace MVC\Command;	
	class SettingProjectUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$Id				= $request->getProperty('Id');
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
			if (!isset($Id))
				return self::statuses('CMD_OK');	
			if ($Type=="on")
				$Type=1;
			else
				$Type=0;
				
			$Str = new \MVC\Library\String($Name." ".$Id);
			$Project = $mProject->find($Id);			
			$Project->setName($Name);
			$Project->setDescription($Description);
			$Project->setAddress($Address);
			$Project->setType1($Type1);
			$Project->setInvestors($Investors);
			$Project->setStretch($Stretch);
			$Project->setPayment($Payment);
			$Project->setDateStart($DateStart);
			$Project->setDateEnd($DateEnd);
			$Project->setType($Type);
			$Project->reKey();
			$mProject->update($Project);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
