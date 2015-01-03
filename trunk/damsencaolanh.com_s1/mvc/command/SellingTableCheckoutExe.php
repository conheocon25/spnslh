<?php
	namespace MVC\Command;
	class SellingTableCheckoutExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			//$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTable = $request->getProperty("IdTable");
			$IdSession = $request->getProperty("IdSession");
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mTable 	= new \MVC\Mapper\Table();			
			$mTableLog 	= new \MVC\Mapper\TableLog();
			$mCourse 	= new \MVC\Mapper\Course();
			$mSession 	= new \MVC\Mapper\Session();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Table = $mTable->find($IdTable);
			$Session = $mSession->find($IdSession);
			
			//Thanh toán đủ
			$Session->setStatus(1);
			$mSession->update($Session);
			
			$TableLog	= new \MVC\Domain\TableLog(
				null,
				$Table->getIdUser(),
				$Table->getId(),
				\date('Y-m-d H:i:s'),
				"tính tiền ".$Session->getValuePrint()
			);
			$mTableLog->insert($TableLog);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>