<?php
require_once("mvc/base/Library.php");
class Viewer {
	function __construct($Path=null){
		$this->Path = $Path;
    }
	
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
		$Out = $tpl->execute();
		unset($tpl);
		
		//Kết xuất dữ liệu ra HTML
		return $Out;
	}
	
	//-------------------------------------------------
	//Hỗ trợ template xuất ra dưới dạng HTML    
	//-------------------------------------------------
	function pdf(){		
		$html = $this->html();		
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetMargins(5, 12, 5);
		$pdf->SetHeaderMargin(1);		
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);			
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 10);					
		$pdf->writeHTML($html, true, false, true, false, '');
		$Out = $pdf->Output("cafe_passion.pdf", 'I');
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
				
		$pdf->setHeaderFont(Array('arial', '', '10'));
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(1, 1, 1);
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
			
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 8);					
		$pdf->writeHTML($html, true, false, true, false, '');
		$Out = $pdf->Output('cafe_mien_tay.pdf', 'I');
		unset($pdf);
		
		return $Out;
	}
	
	function pdfFormatSize() {
		
		$html = $this->html();		
		$pdf = new \CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->reFormat("A4", "L");

		$pdf->setHeaderFont(Array('arial', '', '10'));
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(1, 18, 1);		
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);		
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 8);					
		$pdf->writeHTML($html, true, false, true, false, '');
		return $pdf->Output("cafe_mien_tay_1.pdf", 'I');
	}
}
?>