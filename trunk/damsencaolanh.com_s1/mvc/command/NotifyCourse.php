<?php
	namespace MVC\Command;	
	class NotifyCourse extends Command {
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
			$mCL 		= new \MVC\Mapper\CourseLog();
			$mNotify 	= new \MVC\Mapper\Notify();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$CLAll 		= $mCL->findBy(array());
			if ($CLAll->count()>0){
				$CL 		= $CLAll->current();
				$mCL->delete(array($CL->getId()));
				
				$Notify = new \MVC\Domain\Notify(
					null,
					$CL->getTable()->getDomain()->getName()."/".$CL->getTable()->getName(),
					1,
					$CL->getCourse()->getName().' đã quá thời gian chuẩn bị'
				);
				$mNotify->insert($Notify);				
			}
			
			$NotifyAll = $mNotify->findAll();
			if ($NotifyAll->count()>0){
				$Notify = $NotifyAll->current();
				$mNotify->delete(array($Notify->getId()));
				
				$json = array(
					'result' 	=> "OK",
					'id' 		=> $Notify->getId(),
					'title' 	=> $Notify->getTitle(),
					'type' 		=> $Notify->getType(),
					'message'	=> $Notify->getMessage()
				);
			}
			else{
				$json = array(
					'result' 	=> "NO",
					'id' 		=> '',
					'title' 	=> '',
					'type' 		=> '',
					'message'	=> ''
				);
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			
			echo json_encode($json);
		}
	}
?>