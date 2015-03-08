<?php
	namespace MVC\Command;	
	class ServiceFacebookUpdateUser extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Id			= $request->getProperty("Id");
			$Email		= $request->getProperty("Email");
			$FirstName	= $request->getProperty("FirstName");
			$LastName	= $request->getProperty("LastName");
			$Locale		= $request->getProperty("Locale");
			$TimeZone	= $request->getProperty("TimeZone");
			$Gender		= $request->getProperty("Gender");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mFacebooker 	= new \MVC\Mapper\Facebooker();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$IdCheck = $mFacebooker->checkCode(array($Id));
			if (isset($IdCheck)){
				$Facebooker = $mFacebooker->find($IdCheck);
				$Facebooker->setEmail($Email);
				$Facebooker->setLastName($LastName);
				$Facebooker->setFirstName($FirstName);
				$Facebooker->setTimeZone($TimeZone);
				$Facebooker->setLocale($Locale);
				$Facebooker->setUpdatedTime(date('Y-m-d H:i:s'));
				$mFacebooker->update($Facebooker);
			}else{
				$Facebooker = new \MVC\Domain\Facebooker(
					null,
					$Id,
					$Email,
					$FirstName,
					$LastName,				
					$Gender, 
					$Locale,
					$TimeZone,
					date('Y-m-d H:i:s'),	
					date('Y-m-d H:i:s')
				);
				$mFacebooker->insert($Facebooker);
			}			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>