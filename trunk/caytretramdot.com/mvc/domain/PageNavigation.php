<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class PageNavigation extends Object{
    
	private $nRow;
	private $Size;
	private $Pages;
	
	private $Current;
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( $Rows=0, $Size=0, $URL=null) {
        $this->Size = $Size;
		$this->Rows = $Rows;
		$this->URL = $URL;
    }
	
    function setRows( $Rows) {
        $this->Rows = $Rows;
    }
    function getRows( ) {
        return $this->Rows;
    }
	
	function setSize( $Size) {
        $this->Size = $Size;
    }
    function getSize( ) {
        return $this->Size;
    }
	
	function setCurrent( $Current) {
        $this->Current = $Current;
    }
    function getCurrent( ) {
        return $this->Current;
    }
		
	function setURL( $URL) {
        $this->URL = $URL;        
    }
    function getURL( ) {
        return $this->URL;
    }
	
	function getURLNext( ) {
		if ($this->Current == $this->getPages()->count())
			return $this->URL."&Page=".($this->Current)."#";
        return $this->URL."&Page=".($this->Current+1);
    }
	
	function getURLPrevious( ) {
		if ($this->Current == 1)
			return $this->URL."&Page=1#";
        return $this->URL."&Page=".($this->Current-1);
    }
	
	function getURLFirst( ) {
        return $this->URL."&Page=1";
    }
	
	function getURLLast( ) {
        return $this->URL."&Page=".$this->getPages()->count();
    }
	function IsPaging(){
		$Pages = $this->getPages();
		if ($Pages->count()>1)
			return true;
			
		return false;
	}
	function getPages(){
		if (!isset($this->Pages)){
			$N = ceil($this->Rows/$this->Size);
			$this->Pages = new \MVC\Mapper\PageCollection();
			for ($i=1; $i<=$N; $i++){
				$P = new Page($i, $i, $this->URL."/page/".$i);
				$this->Pages->add($P);
			}
		}
		return $this->Pages;
	}
	function getPagesReduce(){
		if (!isset($this->Pages)){
			$N = ceil($this->Rows/$this->Size);
			$this->Pages = new \MVC\Mapper\PageCollection();
			
			$P = new Page(0, 0, $this->URL."&Page=0");
			$this->Pages->add($P);
			
			if ($this->Current-1>0){
				$P = new Page($this->Current-1, $this->Current-1, $this->URL."&Page=".($this->Current-1));
				$this->Pages->add($P);
			}
			
			if ($this->Current>0 && $this->Current<$N-1){
				$P = new Page($this->Current, $this->Current, $this->URL."&Page=".$this->Current);
				$this->Pages->add($P);
			}
			
			if ($this->Current+1<$N-1){
				$P = new Page($this->Current+1, $this->Current+1, $this->URL."&Page=".($this->Current+1));
				$this->Pages->add($P);
			}
						
			$P = new Page($N-1, $N-1, $this->URL."&Page=".($N-1));
			$this->Pages->add($P);
		}
		return $this->Pages;
	}
}
?>
