<?php
	namespace MVC\Command;
	class SellingDomainTableLogUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------						
			$IdSession = $request->getProperty("IdSession");			
			//$DateTime = $request->getProperty("DateTime");
			//$DateTimeEnd = $request->getProperty("DateTimeEnd");
			$Note = $request->getProperty("Note");
			//$DiscountValue = $request->getProperty("DiscountValue");
			$DiscountPercent = $request->getProperty("DiscountPercent");
			//$Status = $request->getProperty("Status");
			//$Surtax = $request->getProperty("Surtax");
			//$Payment = $request->getProperty("Payment");
			//$IdCustomer = $request->getProperty("IdCustomer");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSession = new \MVC\Mapper\Session();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($IdSession))
				return self::statuses('CMD_OK');
			
			$Session = $mSession->find($IdSession);			
			//$Session->setDateTime($DateTime);
			//$Session->setDateTimeEnd($DateTimeEnd);
			$Session->setNote($Note);
			//$Session->setDiscountValue($DiscountValue);
			$Session->setDiscountPercent($DiscountPercent);
			//$Session->setSurtax($Surtax);
			//$Session->setIdCustomer($IdCustomer);
			//$Session->setStatus($Status);
			//$Session->setPayment($Payment);
			$Session->setValue( $Session->getReValue() );
			
			$mSession->update($Session);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			return self::statuses('CMD_OK');
		}
	}
?>
