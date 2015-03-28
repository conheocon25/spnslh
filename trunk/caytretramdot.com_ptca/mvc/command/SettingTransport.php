<?php
	namespace MVC\Command;	
	class SettingTransport extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 			= $request->getProperty('Page');
			$IdGroup 	= $request->getProperty('IdGroup');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTransportGroup 	= new \MVC\Mapper\TransportGroup();
			$mTransport 		= new \MVC\Mapper\Transport();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$GroupAll = $mTransportGroup->findAll();
			if (!isset($IdGroup)){
				$Group 		= $GroupAll->current();
				$IdGroup 	= $Group->getId();
			}else{
				$Group 		= $mTransportGroup->find($IdGroup);
			}
									
			$TransportAll 	= $mTransport->findByGroup(array($IdGroup));
						
			if (!isset($Page)) $Page=1;
			$Config 		= $mConfig->findByName("ROW_PER_PAGE");
						
			$TransportAll1 	= $mTransport->findByGroupPage(array($IdGroup, $Page, $Config->getValue() ));			
			$PN 			= new \MVC\Domain\PageNavigation($TransportAll->count(), $Config->getValue(), $Group->getURLSetting() );
			
			$Title 		= "PHƯƠNG TIỆN";
			$Navigation = array(array("THIẾT LẬP", "/ql-thiet-lap"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Page'		, $Page);
			$request->setObject('PN'			, $PN);
			$request->setObject('Group'			, $Group);
			$request->setObject('GroupAll'		, $GroupAll);
			$request->setObject('TransportAll1'	, $TransportAll1);
			
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>