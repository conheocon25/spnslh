<?php		
	namespace MVC\Command;	
	class SettingConfig extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page = $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigAll 			= $mConfig->findAll();
												
			$Title 		= "CẤU HÌNH";			
			$Navigation = array(array("THIẾT LẬP", "/admin"));
						
			//Kiểm tra nếu chưa tồn tại trong DB thì sẽ tự động khởi tạo giá trị mặc định và lưu vào DB			
			$ConfigNameApp 	= $mConfig->findByName("NAME_APP");
			if ($ConfigNameApp==null){
				$ConfigNameApp = new \MVC\Domain\Config(null, 'NAME_APP', 'HỆ THỐNG QUẢN LÝ PTC');
				$mConfig->insert($ConfigName);
			}
			
			$ConfigNameCompany 	= $mConfig->findByName("NAME_COMPANY");
			if ($ConfigNameCompany==null){
				$ConfigNameCompany = new \MVC\Domain\Config(null, 'NAME_COMPANY', 'CÔNG TY CỔ PHẦN DẦU KHÍ CỬU LONG');
				$mConfig->insert($ConfigName);
			}
			
			$ConfigAddress 	= $mConfig->findByName("ADDRESS");
			if ($ConfigAddress==null){
				$ConfigAddress = new \MVC\Domain\Config(null, 'ADDRESS', 'Vĩnh Long');
				$mConfig->insert($ConfigAddress);
			}
			
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			if ($ConfigPhone1==null){
				$ConfigPhone1 = new \MVC\Domain\Config(null, 'PHONE1', '0919 153 189');
				$mConfig->insert($ConfigPhone1);
			}
			
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			if ($ConfigPhone2==null){
				$ConfigPhone2 = new \MVC\Domain\Config(null, 'PHONE2', '0996 355 368');
				$mConfig->insert($ConfigPhone2);
			}
			
			$ConfigRowPerPage	= $mConfig->findByName("ROW_PER_PAGE");
			if ($ConfigRowPerPage==null){
				$ConfigRowPerPage = new \MVC\Domain\Config(null, 'ROW_PER_PAGE', 12);
				$mConfig->insert($RowPerPage);
			}
									
			$ConfigGuestVisit 	= $mConfig->findByName("GUEST_VISIT");
			if ($ConfigGuestVisit==null){
				$ConfigGuestVisit = new \MVC\Domain\Config(null, 'GUEST_VISIT', 1);
				$mConfig->insert($ConfigGuestVisit);
			}
			
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			if ($ConfigSlogan==null){
				$ConfigSlogan = new \MVC\Domain\Config(null, 'SLOGAN', 'Khẩu hiệu của Shop');
				$mConfig->insert($ConfigSlogan);
			}
															
			$ConfigTimer1	= $mConfig->findByName("TIMER_01");
			if ($ConfigTimer1==null){
				$ConfigTimer1 = new \MVC\Domain\Config(null, 'TIMER_01', 1);
				$mConfig->insert($ConfigTimer1);
			}
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject('ConfigNameApp', 			$ConfigNameApp);
			$request->setObject('ConfigNameCompany', 		$ConfigNameCompany);
			$request->setObject('ConfigAddress', 			$ConfigAddress);
			$request->setObject('ConfigPhone1', 			$ConfigPhone1);
			$request->setObject('ConfigPhone2', 			$ConfigPhone2);			
			$request->setObject('ConfigRowPerPage', 		$ConfigRowPerPage);			
			$request->setObject('ConfigGuestVisit', 		$ConfigGuestVisit);
			$request->setObject('ConfigSlogan', 			$ConfigSlogan);
			$request->setObject('ConfigTimer1', 			$ConfigTimer1);
			
			$request->setProperty('Title',					$Title);			
			$request->setObject('Navigation',				$Navigation);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>