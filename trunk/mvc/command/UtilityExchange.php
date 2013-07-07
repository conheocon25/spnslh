<?php
	namespace MVC\Command;	
	class UtilityExchange extends Command{
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
			$mCategoryGeneral = new \MVC\Mapper\CategoryGeneral();
			$mCategoryMarket = new \MVC\Mapper\CategoryMarket();
			$mCategoryProject = new \MVC\Mapper\CategoryProject();
			$mCategoryKnowledge = new \MVC\Mapper\CategoryKnowledge();
			$mProject = new \MVC\Mapper\Project();
			$mContact = new \MVC\Mapper\Contact();
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Công cụ xem và đổi tỉ giá ngoại tệ hiện tại";
			$CategoryGenerals = $mCategoryGeneral->findAll();
			$CategoryMarkets = $mCategoryMarket->findAll();
			$CategoryProjects = $mCategoryProject->findAll();
			$CategoryKnowledges = $mCategoryKnowledge->findAll();
			
			$Projects = $mProject->findAll();
			$Contacts = $mContact->findAll();
			$Agencies = $mAgency->findAll();
								
			$xml = simplexml_load_file('http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx');
	
			$str_DateTime = "";
			$str_Source = "";			
			$arExchange = Array();			
			$arChangeExchange = Array();			
			$i=0;
			
			
			foreach($xml->children() as $child)
			  {
				if( ($child->getName() == "DateTime") || ($child->getName() == "Source")) {
					if( $child->getName() == "DateTime") {
						$str_DateTime =  "Ngày: ". $child;
					}
					else {
						$str_Source =  "Nguồn: ". $child;
					}
				}
				else {	
					
					$arExchange[$i] = array (
							"Name" => $child->attributes()->CurrencyName,
							"Code" => $child->attributes()->CurrencyCode,
							"Buy" => $child->attributes()->Buy,
							"Transfer" => $child->attributes()->Transfer,
							"Sell" => $child->attributes()->Sell	);					
					$i++;	
			
					}
			  }	
			
			
			
			$request->setProperty("arExchange", $arExchange);			
			$request->setProperty("str_DateTime", $str_DateTime);
			$request->setProperty("str_Source", $str_Source);			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("CategoryGenerals", $CategoryGenerals);
			$request->setObject("CategoryMarkets", $CategoryMarkets);
			$request->setObject("CategoryProjects", $CategoryProjects);
			$request->setObject("CategoryKnowledges", $CategoryKnowledges);
			
			$request->setObject("Projects", $Projects);
			$request->setObject("Contacts", $Contacts);
			$request->setObject("Agencies", $Agencies);
			
			$request->setProperty("Title", $Title);
			
			$request->setProperty("ActiveMenu", 'Exchange');
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>