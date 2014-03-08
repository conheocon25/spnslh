<?php
require_once("mvc/base/Library.php");
class Viewer {
	function __construct($Path=null){$this->Path = $Path;}
	
	//-------------------------------------------------
	//Hỗ trợ template xuất ra dưới dạng HTML    
	//-------------------------------------------------
	function html(){
		//Lấy các tham số toàn cục
		$Session = \MVC\Base\SessionRegistry::instance();		
						
		//Lấy các tham số đã được xử lí
		$request = \MVC\Base\RequestRegistry::getRequest();
		$objects = $request->getObjects();
		$properties = $request->getProperties();
		
		//Khởi tạo template và chuyển các thuộc tính và đối tượng sang
		$tpl = new PHPTAL($this->Path);
		while (list($key, $val) = each($objects)){			
			if (substr($key, 0, 1)!='_')
				$tpl->$key = $val;			
		}
		while (list($key, $val) = each($properties)){			
			if (substr($key, 0, 1)!='_')
				$tpl->$key = $val;
		}
		$Html = $tpl->execute();
		
		//Giải phóng bộ nhớ bị rò rỉ
		unset($tpl);
		unset($objects);
		unset($properties);
		
		//Kết xuất dữ liệu ra HTML
		return $Html;
	}
	
	//-------------------------------------------------
	//Hỗ trợ template xuất ra dưới dạng HTML    
	//-------------------------------------------------
	function pdf(){
			
		$html = $this->html();		
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetMargins(3, 1, 3);
		
		$pdf->setPrintHeader(false);
		
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 10);					
		$pdf->writeHTML($html, true, false, true, false, '');
		$Out = $pdf->Output("report_muoi_ot_xanh.pdf", 'I');
		unset($pdf);
		return $Out;
	}
	
	function custompdf(){		
		$html = $this->html();		
		$pdf = new \CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$width = 73; //76 mm 
		$height = 297; //30 mmm mac dinh nhung 1 vong giay la 83 mm	
		$pdf->addFormat("custom", $width, $height);  
		$pdf->reFormat("custom", 'P');
		
		// set default header data		
		$pdf->setHeaderFont(Array('arial', '', '10'));
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(1, 18, 1);
		
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
				
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 8);					
		$pdf->writeHTML($html, true, false, true, false, '');
		$Out = $pdf->Output('phieu_muoi_ot_xanh.pdf', 'I');
		unset($Out);
		return $Out;
	}			
}
?>