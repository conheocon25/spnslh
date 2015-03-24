<?php		
	namespace MVC\Command;	
	class ASettingTypeAccount extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdParent = $request->getProperty('IdParent');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTypeAccount 	= new \MVC\Mapper\TypeAccount();			
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($IdParent)) $IdParent = 1;
			
			$TypeAccountParent = $mTypeAccount->find($IdParent);
			$TypeAccountAll = $mTypeAccount->findByParent(array($IdParent));
			
			$TypeAccountAll1 = $mTypeAccount->findAll();
			$TypeAccountAll1->add($TypeAccountParent);
			
			$TypeAccountSibblingAll = $mTypeAccount->findByParent(array($TypeAccountParent->getIdParent()));
						
			$Title = mb_strtoupper($TypeAccountParent->getName(), 'UTF8');
			
			if ($TypeAccountParent->getIdParent()>0){
				$Navigation = array(				
					array( "THIẾT LẬP", "/admin" ),
					array( mb_strtoupper($TypeAccountParent->getParent()->getName(), 'UTF8'), $TypeAccountParent->getParent()->getURLSettingTypeAccount() )
				);
			}else{
				$Navigation = array(				
					array( "THIẾT LẬP", "/admin" ),
					array( mb_strtoupper($TypeAccountParent->getName(), 'UTF8'), $TypeAccountParent->getURLSettingTypeAccount() )
				);
			}
			
			$ConfigName	= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'			, $Title);
			$request->setProperty('ActiveAdmin'		, 'TypeAccount');			
			$request->setObject('Navigation'		, $Navigation);
			
			$request->setObject('ConfigName'				, $ConfigName);			
			$request->setObject('TypeAccountParent'			, $TypeAccountParent);
			$request->setObject('TypeAccountAll'			, $TypeAccountAll);
			$request->setObject('TypeAccountAll1'			, $TypeAccountAll1);
			$request->setObject('TypeAccountSibblingAll'	, $TypeAccountSibblingAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>