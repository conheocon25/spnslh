<?php		
	namespace MVC\Command;	
	class APostDetail extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTag 	= $request->getProperty('IdTag');
			$IdPost = $request->getProperty('IdPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mPost 	= new \MVC\Mapper\Post();
			$mPT 	= new \MVC\Mapper\PostTag();
			$mConfig= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$PTAll 	= $mPT->findByTagPost(array($IdTag, $IdPost));
			$PT		= $PTAll->current();
			
			$Title 	= mb_strtoupper($PT->getPost()->getTitle(), 'UTF8');
			$Navigation = array(								
				array(mb_strtoupper($PT->getTag()->getName(), 'UTF8'), 	$PT->getTag()->getURLSettingPost())
			);
			$ConfigName		= $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);			
			$request->setProperty('ActiveAdmin'	, 'Post');			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('PT'			, $PT);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>