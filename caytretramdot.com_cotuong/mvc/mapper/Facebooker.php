<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Facebooker extends Mapper implements \MVC\Domain\FacebookerFinder {

    function __construct() {
        parent::__construct();
		$tblFacebooker = "tbl_facebooker";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblFacebooker);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblFacebooker);
		$updateStmt 	= sprintf("update %s set code=?, email=?, first_name=?, last_name=?, gender=?, locale=?, timezone=?, created_time=?, updated_time=? where id=?", $tblFacebooker);
		$insertStmt 	= sprintf("insert into %s (
				`code`, 					
				`email`,
				`first_name`, 
				`last_name`, 
				`gender`,
				`locale`, 					
				`timezone`, 					
				`created_time`, 
				`updated_time`					
			) 
			values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblFacebooker);
		$deleteStmt = sprintf("delete from %s where id=?", $tblFacebooker);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblFacebooker);
				
		$checkCode 		= sprintf("select distinct id from %s where code=?", $tblFacebooker);
		$checkEmailStmt = sprintf("select distinct id from %s where email=?", $tblFacebooker);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
		$this->checkCode = self::$PDO->prepare($checkCode);
		$this->checkEmailStmt = self::$PDO->prepare($checkEmailStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {
        return new FacebookerCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Facebooker( 
			$array['id'],  
			$array['code'],
			$array['email'],
			$array['first_name'],
			$array['last_name'],
			$array['gender'],
			$array['locale'],
			$array['timezone'],
			$array['created_time'],
			$array['updated_time']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "Facebooker";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getCode(),			
			$object->getEmail(),			
			$object->getFirstName(),
			$object->getLastName(),
			$object->getGender(),
			$object->getLocale(),			
			$object->getTimeZone(),	
			$object->getCreatedDate(),
			$object->getUpdatedDate()
		);		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getCode(),
			$object->getEmail(),			
			$object->getFirstName(),
			$object->getLastName(),
			$object->getGender(),
			$object->getLocale(),			
			$object->getTimeZone(),	
			$object->getCreatedDate(),
			$object->getUpdatedDate(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
		
	function checkCode($Code) {			
        $this->checkCode->execute( $Code);
        $result = $this->checkCode->fetchAll();
		if (!isset($result) || $result==null)
			return null; 
		return @$result[0][0];
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
        return new FacebookerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>