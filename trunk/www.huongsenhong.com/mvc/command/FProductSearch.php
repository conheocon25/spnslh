<?php
	namespace MVC\Command;	
	class FProductSearch extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Term 			= 	$request->getProperty('Term');
			$Price1 		= 	(int)($request->getProperty('Price1'));
			$Price2 		= 	(int)($request->getProperty('Price2'));
			$Page 			= 	$request->getProperty('Page');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1		= new \MVC\Mapper\Category1();
			$mTag			= new \MVC\Mapper\Tag();
			$mProduct		= new \MVC\Mapper\Product();
			$mBranch 		= new \MVC\Mapper\Branch();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "";
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigYahooMessenger 	= $mConfig->findByName("CONTACT_YAHOOMESSENGER");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$CategoryAll 	= $mCategory->findAll();			
			$TagAll 		= $mTag->findByPosition(array(1));
			$BranchAll 		= $mBranch->findAll();
												
			$Cond = " name like '$Term%' ";
			if ( $Price1 > 0&&$Price2 > 0 )
				$Cond = $Cond." AND price2>=$Price1 AND price2<=$Price2 ";
			
			if (!isset($Term)&!isset($Price1)&!isset($Price2)){
				$Cond = $Session->getTermSearch();
			}else{				
				$Session->setTermSearch( $Cond );
			}			
			if (!isset($Page)) $Page = 1;
			
			$ProductAll1 	= $mProduct->findByCondition($Cond);
			$ProductAll 	= $mProduct->findByConditionPage(array($Cond, $Page, 9));
			$PN 			= new \MVC\Domain\PageNavigation($ProductAll1->count(), 9, "/tim-kiem");
						
			$Title = "TÌM KIẾM ";
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);			
			$request->setProperty("Active", 			"Category");
			$request->setProperty("Term", 				$Term);
			$request->setProperty("Page", 				$Page);
			$request->setObject("PN", 					$PN);
									
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigYahooMessenger", $ConfigYahooMessenger);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			
			$request->setObject("CategoryAll", 			$CategoryAll);			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("ProductAll", 			$ProductAll);
			$request->setObject("ProductAll1", 			$ProductAll1);
			$request->setObject("BranchAll", 			$BranchAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>