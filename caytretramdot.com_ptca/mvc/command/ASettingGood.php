<?php
	namespace MVC\Command;	
	class ASettingGood extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdGroup	= $request->getProperty('IdGroup');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mGoodGroup 	= new \MVC\Mapper\GoodGroup();
			$mGood 			= new \MVC\Mapper\Good();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$GoodGroupAll	= $mGoodGroup->findAll();
			$Group			= $mGoodGroup->find($IdGroup);
			$GoodAll 		= $mGood->findByGroup(array($IdGroup));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$GoodAll1 		= $mGood->findByGroupPage(array($IdGroup, $Page, $Config->getValue() ));
			$PN 			= new \MVC\Domain\PageNavigation($GoodAll->count(), $Config->getValue(), "/admin/setting/good");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('Group'			, $Group);
			$request->setObject('GoodGroupAll'	, $GoodGroupAll);
			$request->setObject('GoodAll'		, $GoodAll);
			$request->setObject('GoodAll1'		, $GoodAll1);
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>