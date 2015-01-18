<?php		
	namespace MVC\Command;	
	class APostTag extends Command{
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
			$mPost 		= new \MVC\Mapper\Post();
			$mTag 		= new \MVC\Mapper\Tag();
			$mPT 		= new \MVC\Mapper\PostTag();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Post 		= $mPost->find($IdPost);
			$TagAll		= $mTag->findAll();
			
			$PTAll 		= $mPT->findByTagPost(array($IdTag, $IdPost));
			$PT			= $PTAll->current();
			
			$Title 		= "THẺ BÀI";
			$Navigation = array(
				array(mb_strtoupper($PT->getTag()->getName(), 'UTF8'), 	$PT->getTag()->getURLSettingPost()),
				array(\mb_strtoupper($PT->getPost()->getTitle(), 'UTF8'), $PT->getURLSetting())
			);
			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
											
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Post'			, $Post);
			$request->setObject('TagAll'		, $TagAll);
			$request->setObject('ConfigName'	, $ConfigName);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>