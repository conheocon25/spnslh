<?php
	namespace MVC\Command;
	use MVC\Library\Captcha;
	class Register extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			$mCaptcha = new Captcha();
			$mCaptcha->createImage();
			$Session->setCurrentCaptcha($mCaptcha->getSecurityCode());		
			$MsgCaptcha = $request->getProperty('MsgCaptcha');
									
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryEstate = new \MVC\Mapper\CategoryEstate();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mNewsMarket = new \MVC\Mapper\NewsMarket();
			$mNewsGeneral = new \MVC\Mapper\NewsGeneral();
			$mAgency = new \MVC\Mapper\Agency();
			$mProject = new \MVC\Mapper\Project();
			$mContact = new \MVC\Mapper\Contact();
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Website Nhà đất Sài Gòn";
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryMarkets1 = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryEstates = $mCategoryEstate->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			$CategoryKnowledges1 = $mCategoryKnowledge->findAll();
			$NMs = $mNewsMarket->findAll();
			$NMTops = $mNewsMarket->findByPage(array(1, 6));
			$NGs = $mNewsGeneral->findAll();
			$NGTops = $mNewsGeneral->findByPage(array(1, 7));
			$NGFirst = $NGTops->current();
			$Agencies = $mAgency->findAll();
			$Projects = $mProject->findAll();
			$Contacts = $mContact->findAll();
			
			
			$NewsAll = $mNewsGeneral->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryMarkets1", $CategoryMarkets1);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryEstates", $CategoryEstates);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);			
			$request->setObject("NMs", $NMs);
			$request->setObject("NMTops", $NMTops);
			$request->setObject("NGs", $NGs);
			$request->setObject("NGTops", $NGTops);
			$request->setObject("NGFirst", $NGFirst);
			$request->setObject("Agencies", $Agencies);
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			
			
			$request->setProperty("Title", "Liên hệ");
			
			
			$request->setProperty("ActiveMenu", 'Contact');
			
			if ($MsgCaptcha != ""){	
				$request->setProperty("MsgCaptcha", $MsgCaptcha);
			}
			else{
				$request->setProperty("MsgCaptcha", '');
			}
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>