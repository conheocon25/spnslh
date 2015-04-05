<?php		
	namespace MVC\Command;	
	class SettingUserBranchRole extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdUser = $request->getProperty('IdUser');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mUser 		= new \MVC\Mapper\User();
			$mRole 		= new \MVC\Mapper\Role();
			$mBranch	= new \MVC\Mapper\Branch();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$UserSelect	= $mUser->find($IdUser);
			$RoleAll	= $mRole->findAll();
			$UBAll		= $UserSelect->getBranchRole();
			$BranchAll	= $mBranch->findAll();
						
			$Title = mb_strtoupper($UserSelect->getName()." QUẢN LÝ", 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/ql-thiet-lap"),
				array("NGƯỜI DÙNG", "/ql-thiet-lap/nguoi-dung")
			);																		
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			
			$request->setObject('UserSelect'	, $UserSelect);
			$request->setObject('RoleAll'		, $RoleAll);
			$request->setObject('UBAll'			, $UBAll);
			$request->setObject('BranchAll'		, $BranchAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>