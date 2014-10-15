<?php		
	namespace MVC\Command;	
	class CallLogLoading extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------									
			$IdCL	= $request->getProperty('IdCL');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCL 		= new \MVC\Mapper\CourseLog();
			$mNotify 	= new \MVC\Mapper\Notify();
			
			//Xong trước thời hạn bị nhấn xóa
			if (isset($IdCL)){
				$CL = $mCL->find($IdCL);				
				$mCL->delete(array($CL->getId()));
				
				$Notify = new \MVC\Domain\Notify(
					null,
					$CL->getTable()->getDomain()->getName()."/".$CL->getTable()->getName(),
					2,
					$CL->getCourse()->getName().' đã xong món rồi đó kêu bưng ra'
				);
				$mNotify->insert($Notify);
			}
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CLAll 	= $mCL->findAll();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject('CLAll'		, $CLAll);
		}
	}
?>