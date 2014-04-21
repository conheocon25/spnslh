<?php
	namespace MVC\Command;
	use MVC\Library\Mail;
	class RecommendFeedSendEmail extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain = $request->getProperty('IdDomain');
			$Data = $request->getProperty('Data');
			//$Email = $request->getProperty('Email');
			//$Content = $request->getProperty('Content');
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain = new \MVC\Mapper\Domain();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Domain 	= $mDomain->find($IdDomain);			
			$Name = $Domain->getName();			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$Email = $Data[0];			
			$Content = $Data[1];
			
			$doMail = new Mail("mail.caytretramdot.com", "admin@caytretramdot.com", "spncom", "admin368189");
			
			if (isset($Email)) {				
				$MContent = "Website hoidap.caytretramdot.com - Gửi phản hồi tư vấn <br /> Chủ đề: $Name <br />Email Người gửi: $Email <br />	Nội dung:   $Content<br />";			
				$doMail->SendMail("Website hoidap.caytretramdot.com - Gửi phản hồi tư vấn", "admin@caytretramdot.com", "tuanbuithanh@gmail.com", "Website hoidap.caytretramdot.com - Gửi phản hồi tư vấn", $MContent);
				//$doMail->SendMail("Website hoidap.caytretramdot.com - Gửi phản hồi tư vấn", "admin@caytretramdot.com", "thanhbao2007vl@gmail.com", "Website hoidap.caytretramdot.com - Gửi phản hồi tư vấn", $MContent);
				$json = array('result' => "OK");
				echo json_encode($json);
			}else { $json = array('result' => "FALSE"); echo json_encode($json);}
						
		}
	}
?>