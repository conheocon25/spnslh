<?php
namespace MVC\Mapper;
use MVC\Library\Encrypted;
require_once( "mvc/base/Mapper.php" );
class User extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
		$tblUser = "tbl_user";
		
		$selectAllStmt = sprintf("select * from %s", $tblUser);
		$selectStmt = sprintf("select * from %s where id=?", $tblUser);
		$updateStmt = sprintf("update %s set name=?, email=?, pass=?, gender=?, note=?, datecreate=?, dateupdate=?, dateactivity=?, type=?, code=? where id=?", $tblUser);
		$insertStmt = sprintf("insert into %s (					
					name, 
					email,
					pass, 					
					gender,
					note, 					
					datecreate, 
					dateupdate, 
					dateactivity, 
					type,
					code
				) 
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblUser);
		$deleteStmt = sprintf("delete from %s where id=?", $tblUser);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblUser);
		
		$checkStmt = sprintf("select distinct id from %s where email=? and pass=?", $tblUser);
		$checkBarcodeStmt = sprintf("select distinct id from %s where code=?", $tblUser);
		$checkEmailStmt = sprintf("select distinct id from %s where email=?", $tblUser);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->checkStmt = self::$PDO->prepare($checkStmt);
		$this->checkBarcodeStmt = self::$PDO->prepare($checkBarcodeStmt);
		$this->checkEmailStmt = self::$PDO->prepare($checkEmailStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {
        return new UserCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\User( 
			$array['id'],  
			$array['name'],
			$array['email'],
			$array['pass'],				
			$array['gender'],	
			$array['note'],
			$array['datecreate'],
			$array['dateupdate'],
			$array['dateactivity'],
			$array['type'],
			$array['code']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "User";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getEmail(),
			//$this->createPass($object->getPass()),
			$object->getPass(),
			$object->getGender(),
			$object->getNote(),			
			$object->getDateCreate(),
			$object->getDateUpdate(),
			$object->getDateActivity(),
			$object->getType(),
			$object->getCode()
		);		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getEmail(),
			//$this->createPass($object->getPass()),
			$object->getPass(),
			$object->getGender(),			
			$object->getNote(),			
			$object->getDateCreate(),
			$object->getDateUpdate(),
			$object->getDateActivity(),
			$object->getType(),
			$object->getCode(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
		
	function check($name, $pass) {		
        $this->checkStmt->execute( array($name, $pass) );
        $result = $this->checkStmt->fetchAll();		
		return @$result[0][0];
    }
	
	function checkBarcode($barcode) {			
        $this->checkBarcodeStmt->execute( $barcode );
        $result = $this->checkBarcodeStmt->fetchAll();
		if (!isset($result) || $result==null)
			return null; 
		return @$result[0][0];
    }
	function createPass($pass) {
		$Encrypt = new Encrypted();	
		return $Encrypt->setData($pass);
	}
	
	function checkEmail( $values ) {	
        $this->checkEmailStmt->execute( $values );
		$result = $this->checkEmailStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;        
        return $result[0][0];
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new UserCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>