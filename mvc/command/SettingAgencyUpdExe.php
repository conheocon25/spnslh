<?php
	namespace MVC\Command;	
	class SettingAgencyUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdAgency = $request->getProperty('IdAgency');
			$Name = $request->getProperty('Name');
			$Phone = $request->getProperty('Phone');
			$Email = $request->getProperty('Email');
			$Address = $request->getProperty('Address');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Agency = $mAgency->find($IdAgency);
			$Agency->setName($Name);
			$Agency->setPhone($Phone);
			$Agency->setEmail($Email);
			$Agency->setAddress($Address);
			$mAgency->update($Agency);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');
		}
	}
?>