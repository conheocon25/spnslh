<?php
	namespace MVC\Command;	
	class SettingAgencyDelLoad extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$Agency = $mAgency->find($IdAgency);
			$Title = mb_strtoupper($Agency->getName(), 'UTF8');
			
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),
				array("QUẢN LÝ", "/setting"),
				array("NHÀ MÔI GIỚI", "/setting/agency")
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Agency", $Agency);			
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title", $Title);			
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>