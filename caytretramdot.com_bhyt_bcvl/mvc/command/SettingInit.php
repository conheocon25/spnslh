<?php		
	namespace MVC\Command;	
	class SettingInit extends Command {
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
			$mStudentTemp 	= new \MVC\Mapper\StudentTemp();
			$mTable 		= new \MVC\Mapper\Table();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName	= $mConfig->findByName("NAME");
						
			$StudentTempAll = $mStudentTemp->findAll();
			$TableAll 		= $mTable->findAll();
			
			$Valid = 0;
			while ($StudentTempAll->valid()){
				$ST = $StudentTempAll->current();
				if ($ST->checkClass()==true) $Valid += 1;
				$StudentTempAll->next();		
			}
			
			$StudentTempAll1 = $mStudentTemp->findByPage(array($Page, $Config->getValue() ));
			$PN = new \MVC\Domain\PageNavigation($StudentTempAll->count(), $Config->getValue(), "/setting/init" );
			
			$Title = "KHỞI TẠO (".$Valid."/".$StudentTempAll->count()." học sinh)";
			$Navigation = array(array("THIẾT LẬP", "/setting"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);
			$request->setProperty('Page', 			$Page);
			$request->setProperty('fUpdate', 		$StudentTempAll->count()==$Valid&&$Valid>0?1:0);
			$request->setObject('PN', 				$PN);			
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('StudentTempAll', 	$StudentTempAll1);
			$request->setObject('TableAll', 		$TableAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>