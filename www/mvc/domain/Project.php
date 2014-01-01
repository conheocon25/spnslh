<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Project extends Object{

    private $Id;
	private $Name;	
	private $Description;
	private $Address;
	private $Type1;
	private $Investors;
	private $Stretch;
	private $Payment;
	private $DateStart;
	private $DateEnd;
	private $Type;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct(
		$Id=null,
		$Name=null,
		$Description=null,
		$Address=null,
		$Type1=null,
		$Investors=null,
		$Stretch=null,
		$Payment=null,
		$DateStart=null,
		$DateEnd=null,
		$Type=null,
		$Key=null
	){
		$this->Id = $Id;
		$this->Name = $Name;		
		$this->Description = $Description;
		$this->Address = $Address;
		$this->Type1 = $Type1;
		$this->Investors = $Investors;
		$this->Stretch = $Stretch;
		$this->Payment = $Payment;
		$this->DateStart = $DateStart;
		$this->DateEnd = $DateEnd;
		$this->Type = $Type;
		$this->Key = $Key;
	
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
		
	function setDescription( $Description ){$this->Description = $Description;$this->markDirty();}   
	function getDescription( ) {return $this->Description;}
	function getDescriptionReduce( ){$S = new \MVC\Library\String($this->Description);return $S->reduceHTML(350);}
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setAddress( $Address ){$this->Address = $Address;$this->markDirty();}   
	function getAddress( ) {return $this->Address;}
	
	function setType1( $Type1 ){$this->Type1 = $Type1;$this->markDirty();}   
	function getType1( ) {return $this->Type1;}
	
	function setInvestors( $Investors ){$this->Investors = $Investors;$this->markDirty();}   
	function getInvestors( ) {return $this->Investors;}
	
	function setStretch( $Stretch ){$this->Stretch = $Stretch;$this->markDirty();}   
	function getStretch( ) {return $this->Stretch;}
	
	function setPayment( $Payment ){$this->Payment = $Payment;$this->markDirty();}   
	function getPayment( ) {return $this->Payment;}
	
	function setDateStart( $DateStart ){$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}
	function getDateStartPrint( ){$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ){$this->DateEnd = $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}
	function getDateEndPrint( ){$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
	
	function setType( $Type ){$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	function isVIP(){if ($this->Type == 1)return true;return false;}
	
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Description, $matches)){
			$first_img = $matches[1][0];
		}
		else {
			$first_img = "/mvc/templates/theme/base/img/items/1.jpg";
		}
		return $first_img;
	}
			
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name' 			=> $this->getName(),			
			'Description'	=> $this->getDescription(),
			'Address'		=> $this->getAddress(),
			'Type1'			=> $this->getType1(),
			'Investors'		=> $this->getInvestors(),
			'Stretch'		=> $this->getStretch(),
			'Payment'		=> $this->getPayment(),
			'DateStart'		=> $this->getDateStart(),
			'DateEnd'		=> $this->getDateEnd(),
			'Type'			=> $this->getType(),
			'Key'			=> $this->getKey()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->Name 		= $Data[1];			
		$this->Description 	= $Data[2];
		$this->Address 		= $Data[3];
		$this->Type1		= $Data[4];
		$this->Investors	= $Data[5];
		$this->Stretch		= $Data[6];
		$this->Payment		= $Data[7];
		$this->DateStart	= $Data[8];
		$this->DateEnd		= $Data[9];
		$this->Type 		= $Data[10];
		$this->Key 			= $Data[11];
		
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNewsAll(){
		$mNews = new \MVC\Mapper\PNews();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	
	function getProductAll(){
		$mPProduct = new \MVC\Mapper\PProduct();
		$ProductAll = $mPProduct->findBy(array($this->getId()));
		return $ProductAll;
	}
	
	function getDocumentAll(){
		$mDoc = new \MVC\Mapper\PDocument();
		$DocAll = $mDoc->findBy(array($this->getId()));
		return $DocAll;
	}
	
	function getAlbumAll(){
		$mAlbum = new \MVC\Mapper\PAlbum();
		$AlbumAll = $mAlbum->findBy(array($this->getId()));
		return $AlbumAll;
	}
	function getVideoAll(){
		$mVideo = new \MVC\Mapper\PVideo();
		$VideoAll = $mVideo->findBy(array($this->getId()));
		return $VideoAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/du-an/".$this->getKey();}
	function getURLAlbum(){return "/du-an/".$this->getKey()."/hinh-anh";}
	function getURLNews(){return "/du-an/".$this->getKey()."/tin-tuc";}
	function getURLVideo(){return "/du-an/".$this->getKey()."/video";}
	function getURLProduct(){return "/du-an/".$this->getKey()."/hang-muc";}
	function getURLDocumment(){return "/du-an/".$this->getKey()."/tai-lieu";}
	
	function getURLSettingNews(){return "/setting/project/".$this->getId()."/news";}
	function getURLSettingAlbum(){return "/setting/project/".$this->getId()."/album";}
	function getURLSettingVideo(){return "/setting/project/".$this->getId()."/video";}
	function getURLSettingProduct(){return "/setting/project/".$this->getId()."/product";}
	function getURLSettingDocument(){return "/setting/project/".$this->getId()."/document";}

	function getURLUpdLoad(){return "/setting/project/".$this->getId()."/upd-load";}
	function getURLUpdExe(){return "/setting/project/".$this->getId()."/upd-exe";}
	function getURLDelLoad(){return "/setting/project/".$this->getId()."/del-load";}
	function getURLDelExe(){return "/setting/project/".$this->getId()."/del-exe";}
	
	function getURLInsNewsLoad(){return "/setting/project/".$this->getId()."/news/ins-load";}
	function getURLInsNewsExe(){return "/setting/project/".$this->getId()."/news/ins-exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>