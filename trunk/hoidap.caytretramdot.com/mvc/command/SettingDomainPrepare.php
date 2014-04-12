<?php		
	namespace MVC\Command;	
	class SettingDomainPrepare extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty('IdDomain');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain = new \MVC\Mapper\Domain();
			$mClause = new \MVC\Mapper\Clause();
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Domain 		= $mDomain->find($IdDomain);
			$QuestionAll 	= $Domain->getQuestionAll();
			$SolveAll 		= $Domain->getSolveAll();
			
			//Chuẩn bị Data
			$nQ = $QuestionAll->count();
			$nS = $SolveAll->count();
			
			$ArrQ = array();
			$ArrQ[] = array("__","__",0);
			$ArrQ[] = array("__","__",0);
			
			while ($QuestionAll->valid()){
				$ArrQ[] = array("Q".$QuestionAll->current()->getId(), $QuestionAll->current()->getNameStr(), 		0, $QuestionAll->current()->getId());
				$ArrQ[] = array("!Q".$QuestionAll->current()->getId(), $QuestionAll->current()->getNameNotStr(),	0, $QuestionAll->current()->getId());
				$QuestionAll->next();
			}
			
			$ArrS = array();			
			while ($SolveAll->valid()){
				$ArrS[] = array(
								"S".$SolveAll->current()->getId(),
								$SolveAll->current()->getName());								
				$SolveAll->next();
			}
			
			$SolveAll->rewind();
			$ArrD = array();
			while ($SolveAll->valid()){
				$Solve = $SolveAll->current();
				$QuestionAll->rewind();
				
				$DT = array();
				$DT[] = "S".$Solve->getId();
				$DT[] = "S".$Solve->getId();
				
				$IQ = 1;
				while($QuestionAll->valid()){
					$Question = $QuestionAll->current();
					$IdClause = $mClause->exist(array($Solve->getId(), $Question->getId()));
					if (isset($IdClause)){
						$Clause = $mClause->find($IdClause);
						if ($Clause->getState()==1){
							$ArrQ[$IQ*2][2] = $ArrQ[$IQ*2][2]+1;
							$DT[] =  1;
							$DT[] =  0;
						}else{							
							$ArrQ[$IQ*2+1][2] = $ArrQ[$IQ*2+1][2]+1;
							$DT[] =  0;
							$DT[] =  1;
						}
					}	
					else{
						$DT[] =  0;
						$DT[] =  0;
					}											
					$IQ++;
					$QuestionAll->next();
				}				
				$ArrD[] = $DT;
				$SolveAll->next();
			}
			
			//==============================================================================
			//SẮP XẾP DỮ LIỆU
			//==============================================================================
			for ($i=2; $i< (count($ArrQ)-1); $i++){
				for ($j=$i; $j<count($ArrQ); $j++){
					if ($ArrQ[$i][2] < $ArrQ[$j][2]){
						$Temp 		= $ArrQ[$i];
						$ArrQ[$i] 	= $ArrQ[$j];
						$ArrQ[$j] 	= $Temp;
						
						for ($z=0; $z<count($ArrD); $z++){
							$TempZ 			= $ArrD[$z][$i];
							$ArrD[$z][$i] 	= $ArrD[$z][$j];
							$ArrD[$z][$j] 	= $TempZ;
						}
					}
				}
			}
			
			//==============================================================================
			//LƯU TRỮ TẠM VÀO SESSION SAU NÀY SẼ LƯU FILE NẠP VÀO CACHE
			//==============================================================================
			$Session->setArrD($ArrD);
			$Session->setArrS($ArrS);
			$Session->setArrQ($ArrQ);
			
			$Title = "CHUẨN BỊ DỮ LIỆU";
			$Navigation = array(
					array("THIẾT LẬP", 	"/setting"),
					array("LĨNH VỰC", 	"/setting/domain")
			);
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Domain'		, $Domain);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('SolveAll'		, $SolveAll);
			$request->setObject('QuestionAll'	, $QuestionAll);
			$request->setObject('ArrD'			, $ArrD);
			$request->setObject('ArrS'			, $ArrS);
			$request->setObject('ArrQ'			, $ArrQ);
			$request->setProperty('Title'		, $Title);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>