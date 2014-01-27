<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Domain extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Name;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null) {
		$this->Id = $Id;
		$this->Name = $Name;
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() {return $this->Name;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id = $Data[0];	
		$this->Name = $Data[1];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
	function getTableAll(){		
		$mTable = new \MVC\Mapper\Table();
		$TableAll = $mTable->findByDomain(array($this->getId()));		
		return $TableAll;
	}
	
	function getSessionByDate($Date){
		$mSession 	= new \MVC\Mapper\Session();
		$SessionAll = $mSession->findByDomainTracking(array($this->getId(), $Date." 0:0:0", $Date." 23:59:59"));
		return $SessionAll;
	}
	
	function getSessionByDateValue($Date){
		$Sessions = $this->getSessionByDate($Date);
		$Sum = 0;
		$Sessions->rewind();
		while($Sessions->valid()){
			$Session = $Sessions->current();
			$Sum += $Session->getValue();
			$Sessions->next();
		}
		return $Sum;
	}	
	function getSessionByDateValuePrint($Date){
		$num = new \MVC\Library\Number($this->getSessionByDateValue($Date));
		return $num->formatCurrency();
	}
	
	function getSessionByDateValue1($Date){
		$Sessions = $this->getSessionByDate($Date);
		$Sum = 0;
		$Sessions->rewind();
		while($Sessions->valid()){			
			$Session = $Sessions->current();
			if ($Session->getStatus()==0)
				$Sum += $Session->getValue();
			$Sessions->next();
		}
		return $Sum;
	}	
	function getSessionByDateValue1Print($Date){
		$num = new \MVC\Library\Number($this->getSessionByDateValue1($Date));
		return $num->formatCurrency();
	}
	
	function getSessionByDateValue2($Date){
		$Sessions = $this->getSessionByDate($Date);
		$Sum = 0;
		$Sessions->rewind();
		while($Sessions->valid()){			
			$Session = $Sessions->current();
			if ($Session->getStatus()==1)
				$Sum += $Session->getValue();
			$Sessions->next();
		}
		return $Sum;
	}	
	function getSessionByDateValue2Print($Date){
		$num = new \MVC\Library\Number($this->getSessionByDateValue2($Date));
		return $num->formatCurrency();
	}
			
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	return "/setting/domain/".$this->getId()."/upd/load";}
	function getURLUpdExe(){	return "/setting/domain/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){	return "/setting/domain/".$this->getId()."/del/load";}
	function getURLDelExe(){	return "/setting/domain/".$this->getId()."/del/exe";}
					
	function getURLTable(){		return "/setting/domain/".$this->getId();}
	function getURLTableInsLoad(){return "/setting/domain/".$this->getId()."/ins/load";}
	function getURLTableInsExe(){return "/setting/domain/".$this->getId()."/ins/exe";}
	
	function getURLSelling(){return "/selling/".$this->getId();}
			
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>