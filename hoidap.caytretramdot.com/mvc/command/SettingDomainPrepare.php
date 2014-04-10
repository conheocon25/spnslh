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
			while ($QuestionAll->valid()){
				$ArrQ[] = "Q".$QuestionAll->current()->getId();
				$QuestionAll->next();
			}
			
			$ArrS = array();
			while ($SolveAll->valid()){
				$ArrS[] = "S".$SolveAll->current()->getId();
				$SolveAll->next();
			}
			
			$SolveAll->rewind();
			$ArrD = array();
			while ($SolveAll->valid()){
				$Solve = $SolveAll->current();
				$QuestionAll->rewind();
				
				$DT = array();
				while($QuestionAll->valid()){
					$Question = $QuestionAll->current();
					$DT[] =  $Question->getId();
					$QuestionAll->next();
				}				
				$ArrD[] = $DT;
				$SolveAll->next();
			}			
			print_r($ArrD);
			
			//print_r($ArrQ);
			//print_r($ArrS);
			//echo "So cau hoi".$nQ;
			//echo "So giai phap ".$nS;
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Domain'		, $Domain);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>