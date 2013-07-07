<?php
	namespace MVC\Command;	
	class UtilityExchangeAjax extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Exchange = $request->getProperty('Exchange');
			$Value = $request->getProperty('Value');
			
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			
			
								
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
					if($Exchange == "ALL") {
						$arChangeExchange[$i] = array (
							"Name" => $child->attributes()->CurrencyName,
							"Code" => $child->attributes()->CurrencyCode,
							"Buy" => floatval($Value) / floatval($child->attributes()->Buy) ,
							"Transfer" => floatval($Value) / floatval($child->attributes()->Transfer),
							"Sell" => floatval($Value) / floatval($child->attributes()->Sell));
					}
					else
					{
						if($Exchange == $child->attributes()->CurrencyCode)
						{
							$arChangeExchange[0] = array (
							"Name" => $child->attributes()->CurrencyName,
							"Code" => $child->attributes()->CurrencyCode,
							"Buy" => floatval($Value) / floatval($child->attributes()->Buy) ,
							"Transfer" => floatval($Value) / floatval($child->attributes()->Transfer),
							"Sell" => floatval($Value) / floatval($child->attributes()->Sell));
						}
					}
					$i++;				
					}
			  }	
			
			
			
			
			$request->setProperty("arChangeExchange", $arChangeExchange);			
			$request->setProperty("Value", $Value);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>