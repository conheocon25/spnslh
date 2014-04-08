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
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigAll 		= $mConfig->findAll();
			$CategoryAll 	= $mCategory->findAll();
			
			$Title = "CẤU HÌNH";
			$Navigation = array(				
				array("THIẾT LẬP", "/setting")
			);
			
			//Kiểm tra nếu chưa tồn tại trong DB thì sẽ tự động khởi tạo giá trị mặc định và lưu vào DB			
			$ConfigName 	= $mConfig->findByName("NAME");
			if ($ConfigName==null){
				$ConfigName = new \MVC\Domain\Config(null, 'NAME', 'QUÁN ĂN');
				$mConfig->insert($ConfigName);
			}
			
			$ConfigAddress 	= $mConfig->findByName("ADDRESS");
			if ($ConfigAddress==null){
				$ConfigAddress = new \MVC\Domain\Config(null, 'ADDRESS', 'Vĩnh Long');
				$mConfig->insert($ConfigAddress);
			}
			
			$ConfigPhone 	= $mConfig->findByName("PHONE");
			if ($ConfigPhone==null){
				$ConfigPhone = new \MVC\Domain\Config(null, 'PHONE', '0919 153 189');
				$mConfig->insert($ConfigPhone);
			}
			
			$ConfigRowPerPage	= $mConfig->findByName("ROW_PER_PAGE");
			if ($ConfigRowPerPage==null){
				$ConfigRowPerPage = new \MVC\Domain\Config(null, 'ROW_PER_PAGE', 12);
				$mConfig->insert($RowPerPage);
			}
			
			$ConfigEvery5Minutes = $mConfig->findByName("EVERY_5_MINUTES");
			if ($ConfigEvery5Minutes==null){
				$ConfigEvery5Minutes = new \MVC\Domain\Config(null, 'EVERY_5_MINUTES', 2000);
				$mConfig->insert($ConfigEvery5Minutes);
			}
			
			$ConfigGuestVisit 	= $mConfig->findByName("GUEST_VISIT");
			if ($ConfigGuestVisit==null){
				$ConfigGuestVisit = new \MVC\Domain\Config(null, 'GUEST_VISIT', 1);
				$mConfig->insert($ConfigGuestVisit);
			}
			
			$ConfigDiscount 	= $mConfig->findByName("DISCOUNT");
			if ($ConfigDiscount==null){
				$ConfigDiscount = new \MVC\Domain\Config(null, 'DISCOUNT', 0);
				$mConfig->insert($ConfigDiscount);
			}
			
			$ConfigCategoryAuto = $mConfig->findByName("CATEGORY_AUTO");
			if ($ConfigCategoryAuto==null){
				$ConfigCategoryAuto = new \MVC\Domain\Config(null, 'CATEGORY_AUTO', $CategoryAll->current()->getId());
				$mConfig->insert($ConfigCategoryAuto);
			}
			
			$ConfigSwitchBoardCall	= $mConfig->findByName("SWITCH_BOARD_CALL");
			if ($ConfigSwitchBoardCall==null){
				$ConfigSwitchBoardCall = new \MVC\Domain\Config(null, 'SWITCH_BOARD_CALL', 1);
				$mConfig->insert($ConfigSwitchBoardCall);
			}
			
			$ConfigReceiptVirtualDouble	= $mConfig->findByName("RECEIPT_VIRTUAL_DOUBLE");
			if ($ConfigReceiptVirtualDouble==null){
				$ConfigReceiptVirtualDouble = new \MVC\Domain\Config(null, 'RECEIPT_VIRTUAL_DOUBLE', 1);
				$mConfig->insert($ConfigReceiptVirtualDouble);
			}
			
			$ConfignMonthLog	= $mConfig->findByName("N_MONTH_LOG");
			if ($ConfignMonthLog==null){
				$ConfignMonthLog = new \MVC\Domain\Config(null, 'N_MONTH_LOG', 1);
				$mConfig->insert($ConfignMonthLog);
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title', 				$Title);
			$request->setProperty('ActiveAdmin', 		'Config');
			$request->setObject('Navigation', 			$Navigation);
			$request->setObject('CategoryAll', 			$CategoryAll);
			
			$request->setObject('ConfigName', 				$ConfigName);			
			$request->setObject('ConfigAddress', 			$ConfigAddress);
			$request->setObject('ConfigPhone', 				$ConfigPhone);
			$request->setObject('ConfigRowPerPage', 		$ConfigRowPerPage);
			$request->setObject('ConfigEvery5Minutes', 		$ConfigEvery5Minutes);
			$request->setObject('ConfigGuestVisit', 		$ConfigGuestVisit);
			$request->setObject('ConfigDiscount', 			$ConfigDiscount);
			$request->setObject('ConfigCategoryAuto', 		$ConfigCategoryAuto);
			$request->setObject('ConfigSwitchBoardCall', 	$ConfigSwitchBoardCall);
			$request->setObject('ConfigReceiptVirtualDouble', $ConfigReceiptVirtualDouble);
			$request->setObject('ConfignMonthLog', 			$ConfignMonthLog);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>