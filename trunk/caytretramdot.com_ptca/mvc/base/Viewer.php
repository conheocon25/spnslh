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
		$User = $Session->getCurrentUser();
				
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
		$tpl->User = $User;
		$HTML = $tpl->execute();
		unset($tpl);
		
		//Kết xuất dữ liệu ra HTML
		return $HTML;
	}
	
	//-------------------------------------------------
	//Hỗ trợ template xuất ra dưới dạng HTML    
	//-------------------------------------------------
	function pdfA4($O="P") {
		
		$html = $this->html();		
		$pdf = new \CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->reFormat("A4", $O);
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0.2, 0.2, 0.2, true);
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->AddPage();
		$pdf->SetFont('arial', 'N', 10);					
		$pdf->writeHTML($html, true, false, true, false, '');
		$Out = $pdf->Output("a4_hao_kiet.pdf", 'I');
		unset($pdf);
		
		return $Out;
	}
	
}
?>