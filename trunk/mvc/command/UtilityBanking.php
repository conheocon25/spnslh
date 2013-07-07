<?php
	namespace MVC\Command;	
	class UtilityBanking extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Value = $request->getProperty('Value');
			$Type = $request->getProperty('Type');
			$Rate = $request->getProperty('Rate');
			$Count = $request->getProperty('Count');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			require_once("mvc/base/mapper/MapperDefault.php");
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "Công cụ tính toán lãi suất thực và dòng tiền trả nợ cho một khoản vay";
									
			$AdsAll = $mAds->findAll();
											
			$ArrData = array();
			$SRateValue = 0;
			$ValueNew = 0;
			$NSValueOld = new \MVC\Library\Number($Value);
			$TypeStr="";
			$SRate ="";
			if (isset($Type) && $Type == 0){															
				$TypeStr = "Trả góp theo dư nợ giảm dần";
				$Average = $Value / $Count;
				$Remain = $Value;				
				$ValueNew = 0;			
				for ($i=1; $i<=$Count; $i++){					
					$RateValue = $Remain*$Rate/1200.0;
					$MustPaid = $RateValue + $Average;
					$RateReal = $RateValue*100/$Remain;
					$Remain = $Remain - $Average;
					
					$NMustPaid = new \MVC\Library\Number($MustPaid);
					$NAverage = new \MVC\Library\Number($Average);
					$NRateValue = new \MVC\Library\Number($RateValue);
					$NRemain = new \MVC\Library\Number($Remain);						
					$ArrData[] = array($i, $NMustPaid->formatCurrency(), $NAverage->formatCurrency(), $NRateValue->formatCurrency(), $NRemain->formatCurrency(), $RateReal."%");
					
					$ValueNew += $MustPaid;
					$SRateValue += $RateValue;
					
				}
			}else if ($Type==1){															
				$TypeStr = "Trả góp đều hàng tháng theo lãi suất đơn";
				$Average = $Value / $Count;
				$Remain = $Value;				
				$ValueNew = 0;
				for ($i=1; $i<=$Count; $i++){
					$RateValue = $Value*$Rate/100;
					$MustPaid = $RateValue + $Average;
					$RateReal = \round($RateValue*100/$Remain,1);
					$Remain = $Remain - $Average;
					$ArrData[] = array($i, $MustPaid, $Average, $RateValue, $Remain, $RateReal."%");
					
					$ValueNew += $MustPaid;
					$SRateValue += $RateValue;
				}
			}else if ($Type==2){															
				$TypeStr = "Trả góp đều hàng tháng theo lãi suất kép";
				$Average = $Value / $Count;
				$Remain = $Value;				
				$ValueNew = 0;			
				for ($i=1; $i<=$Count; $i++){
					$RateValue = $Value*$Rate/100*(1 + $Rate/100);
					$MustPaid = $RateValue + $Average;
					$RateReal = \round($RateValue*100/$Remain,1);
					$Remain = $Remain - $Average;
					$ArrData[] = array($i, $MustPaid, $Average, $RateValue, $Remain, $RateReal."%");
					
					$ValueNew += $MustPaid;
					$SRateValue += $RateValue;
				}
			}else if ($Type==3){
				$TypeStr = "Trả góp đều hàng tháng, lãi tính trên dư nợ giảm dần";
				$Rate1 = $Rate/1200.0;
				$F = new \MVC\Library\Financial();
				$MustPaid = $F->PMT($Rate1, $Count, -$Value);
				$ValueNew = $MustPaid * $Count;
				$SRateValue = $ValueNew - $Value;
											
				$Average = 0;
				$Remain = $Value;
				$ArrData[] = array(0, "-", "-", "-", $NSValueOld->formatCurrency(),  "-");
				for ($i=1; $i<=$Count; $i++){
					$RateValue = $Remain*$Rate1;
					$Average = $MustPaid - $RateValue;					
					$Remain = $Remain - $Average;					
					$RateReal = \round($RateValue*100/$Remain,1);
					if ($Remain<1) $RateReal = "0";
					
					$NMustPaid = new \MVC\Library\Number($MustPaid);
					$NAverage = new \MVC\Library\Number($Average);
					$NRateValue = new \MVC\Library\Number($RateValue);
					$NRemain = new \MVC\Library\Number($Remain);
					$ArrData[] = array($i, $NMustPaid->formatCurrency(), $NAverage->formatCurrency(), $NRateValue->formatCurrency(), $NRemain->formatCurrency(), $RateReal."%");
				}
				
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("AdsAll", $AdsAll);
						
			$request->setProperty("Title", $Title);
			$request->setProperty("TypeStr", $TypeStr);
			$request->setProperty("ActiveMenu", 'Utility');
			
			$request->setProperty('Value', $Value);			
			$request->setProperty('Type', $Type);
			$request->setProperty('Rate', $Rate);
			$request->setProperty('Count', $Count);
						
			$request->setProperty('ValueOld', $NSValueOld->formatCurrency());
			$NValueNew = new \MVC\Library\Number($ValueNew);
			$request->setProperty('ValueNew', $NValueNew->formatCurrency());
			$NSRateValue = new \MVC\Library\Number($SRateValue);
			$request->setProperty('SRateValue', $NSRateValue->formatCurrency());
			$request->setProperty('SRate', $SRate);
			
			$request->setProperty('ArrData', $ArrData);			
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>