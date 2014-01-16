<?php
namespace MVC\Mapper;
use MVC\Library\Encrypted;
require_once( "mvc/base/Mapper.php" );
class User extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
		$tblUser = "thanhlongceramic_user";
		
		$selectAllStmt = sprintf("select * from %s", $tblUser);								
		$selectStmt = sprintf("select * from %s where id=?", $tblUser);
		$updateStmt = sprintf("update %s set email=?, pass=?, pass2=?, gender=?, note=?, datecreate=?, dateupdate=?, dateactivity=?, type=? where id=?", $tblUser);
		$insertStmt = sprintf("insert into %s (
					email, 
					pass, 
					pass2, 
					gender, 
					note, 					
					datecreate, 
					dateupdate, 
					dateactivity, 
					type
				) 
				values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblUser);
		$deleteStmt = sprintf("delete from %s where id=?", $tblUser);
		
		$checkStmt = sprintf("select distinct id from %s where email=? and pass=?", $tblUser);
		$checkEmailStmt = sprintf("select distinct id from %s where email=?", $tblUser);
		$authorizeStmt = "
			select
				(exists(
					select *
					from
						cfa_user_command
					where
						command = ? AND scope = 1
				)
				OR
					exists(
						select *
						from
							cfa_user_command
						where
							command = ? AND type = ?
					)
				)as authorize
		";
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->checkStmt = self::$PDO->prepare($checkStmt);
		$this->checkEmailStmt = self::$PDO->prepare($checkEmailStmt);
		$this->authorizeStmt = self::$PDO->prepare($authorizeStmt);

    } 
    function getCollection( array $raw ) {
        return new UserCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\User( 
			$array['id'],  
			$array['email'],			
			$array['pass'],	
			$array['pass2'],	
			$array['gender'],	
			$array['note'],		
			$array['datecreate'],
			$array['dateupdate'],
			$array['dateactivity'],
			$array['type']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "User";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getEmail(),			
			$this->createPass($object->getPass()),	
			$this->createPass($object->getPass2()),	
			$object->getGender(),	
			$object->getNote(),			
			$object->getDateCreate(),
			$object->getDateUpdate(),
			$object->getDateActivity(),
			$object->getType()
		);		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getEmail(),
			$this->createPass($object->getPass()),
			$this->createPass($object->getPass2()),
			$object->getGender(),			
			$object->getNote(),			
			$object->getDateCreate(),
			$object->getDateUpdate(),
			$object->getDateActivity(),
			$object->getType(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {
        return $this->selectStmt;
    }	
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
		
	function check($name, $pass) {		
		$repass = $this->createPass($pass);
		$values = array($name, $repass);	
        $this->checkStmt->execute( $values );
        $result = $this->checkStmt->fetchAll();		
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
	
	function authorize( $values ) {	
        $this->authorizeStmt->execute( $values );
		$result = $this->authorizeStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return 0;
        return $result[0][0];
    }
	
}
?>