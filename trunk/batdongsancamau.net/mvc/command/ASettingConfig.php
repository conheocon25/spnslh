<?php		
	namespace MVC\Command;	
	class ASettingConfig extends Command {
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
			$mPost 			= new \MVC\Mapper\Post();
			$mTag 			= new \MVC\Mapper\Tag();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigAll 		= $mConfig->findAll();
			$Tag 			= $mTag->findByPosition(array(2))->current();
									
			$Title = "CẤU HÌNH";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting")
			);
			
			//Kiểm tra nếu chưa tồn tại trong DB thì sẽ tự động khởi tạo giá trị mặc định và lưu vào DB			
			$ConfigName 	= $mConfig->findByName("NAME");
			if ($ConfigName==null){
				$ConfigName = new \MVC\Domain\Config(null, 'NAME', 'QUÁN CAFE');
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
				$ConfigPhone2 = new \MVC\Domain\Config(null, 'PHONE2', '0919 153 189');
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
												
						
			$ConfigIntroduction = $mConfig->findByName("POST_INTRODUCTION");
			if ($ConfigIntroduction==null){
				$ConfigIntroduction = new \MVC\Domain\Config(null, 'POST_INTRODUCTION', 0);
				$mConfig->insert($ConfigIntroduction);
			}
			
			$ConfigFAQ = $mConfig->findByName("POST_FAQ");
			if ($ConfigFAQ==null){
				$ConfigFAQ = new \MVC\Domain\Config(null, 'POST_FAQ', 0);
				$mConfig->insert($ConfigFAQ);
			}
			
			$ConfigPolicy = $mConfig->findByName("POST_POLICY");
			if ($ConfigPolicy==null){
				$ConfigPolicy = new \MVC\Domain\Config(null, 'POST_POLICY', 0);
				$mConfig->insert($ConfigPolicy);
			}
			
			$ConfigPriceService = $mConfig->findByName("POST_PRICE_SERVICE");
			if ($ConfigPriceService==null){
				$ConfigPriceService = new \MVC\Domain\Config(null, 'POST_PRICE_SERVICE', 0);
				$mConfig->insert($ConfigPriceService);
			}
			
			$ConfigPriceHouse = $mConfig->findByName("POST_PRICE_HOUSE");
			if ($ConfigPriceHouse==null){
				$ConfigPriceHouse = new \MVC\Domain\Config(null, 'POST_PRICE_HOUSE', 0);
				$mConfig->insert($ConfigPriceHouse);
			}
			
			$ConfigPriceLand = $mConfig->findByName("POST_PRICE_LAND");
			if ($ConfigPriceLand==null){
				$ConfigPriceLand = new \MVC\Domain\Config(null, 'POST_PRICE_LAND', 0);
				$mConfig->insert($ConfigPriceLand);
			}
									
			$ConfigContact = $mConfig->findByName("CONTACT_NAME");
			if ($ConfigContact==null){
				$ConfigContact = new \MVC\Domain\Config(null, 'CONTACT_NAME', 'A.Tuấn');
				$mConfig->insert($ConfigContact);
			}
			
			$ConfigYahooMessenger = $mConfig->findByName("CONTACT_YAHOOMESSENGER");
			if ($ConfigYahooMessenger==null){
				$ConfigYahooMessenger = new \MVC\Domain\Config(null, 'CONTACT_YAHOOMESSENGER', 'abc@yahoo.com');
				$mConfig->insert($ConfigYahooMessenger);
			}
			
			$ConfigSkype = $mConfig->findByName("CONTACT_SKYPE");
			if ($ConfigSkype==null){
				$ConfigSkype = new \MVC\Domain\Config(null, 'CONTACT_SKYPE', 'abc@skype.com');
				$mConfig->insert($ConfigSkype);
			}
			
			$ConfigGTalk = $mConfig->findByName("CONTACT_GTALK");
			if ($ConfigGTalk==null){
				$ConfigGTalk = new \MVC\Domain\Config(null, 'CONTACT_GTALK', 'abc@gmail.com');
				$mConfig->insert($ConfigGTalk);
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 				$Title);
			$request->setProperty('ActiveAdmin', 		'Config');
			$request->setObject('Navigation', 			$Navigation);
						
			$request->setObject('ConfigName', 				$ConfigName);			
			$request->setObject('ConfigAddress', 			$ConfigAddress);
			$request->setObject('ConfigPhone1', 			$ConfigPhone1);
			$request->setObject('ConfigPhone2', 			$ConfigPhone2);
			$request->setObject('ConfigContact', 			$ConfigContact);
			$request->setObject('ConfigRowPerPage', 		$ConfigRowPerPage);			
			$request->setObject('ConfigGuestVisit', 		$ConfigGuestVisit);
			$request->setObject('ConfigSlogan', 			$ConfigSlogan);			
						
			$request->setObject('ConfigIntroduction', 		$ConfigIntroduction);
			$request->setObject('ConfigPriceService', 		$ConfigPriceService);
			$request->setObject('ConfigPriceHouse', 		$ConfigPriceHouse);
			$request->setObject('ConfigPriceLand', 			$ConfigPriceLand);
			$request->setObject('ConfigPolicy', 			$ConfigPolicy);	
			$request->setObject('ConfigFAQ', 				$ConfigFAQ);
											
			$request->setObject('ConfigYahooMessenger', 	$ConfigYahooMessenger);
			$request->setObject('ConfigSkype', 				$ConfigSkype);
			$request->setObject('ConfigGTalk', 				$ConfigGTalk);
			
			$request->setObject('Tag', 						$Tag);			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>