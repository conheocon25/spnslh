<?php		
	namespace MVC\Command;	
	class SellingDomainLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty("IdDomain");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if ($IdDomain==101){
				$TableAll = $mTable->findAllNonGuest(array());
			}else if ($IdDomain==102){
				$TableAll = $mTable->findAllGuest(array(-1));
			}else{
				$TableAll = $mTable->findByDomain(array($IdDomain));
			}			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title = "BÁN HÀNG";
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', $Title);
			$request->setObject('TableAll', $TableAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>