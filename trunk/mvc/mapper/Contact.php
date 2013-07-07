<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Contact extends Mapper implements \MVC\Domain\ContactFinder {

    function __construct() {
        parent::__construct();
				
		$tblContact = "saigonlandhouse_contact";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblContact);
		$selectStmt = sprintf("select *  from %s where id=?", $tblContact);
		$updateStmt = sprintf("update %s set name=?, pic_url=?, website=? where id=?", $tblContact);
		$insertStmt = sprintf("insert into %s ( name, pic_url, website) values(?, ?, ?)", $tblContact);
		$deleteStmt = sprintf("delete from %s where id=?", $tblContact);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new ContactCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Contact( 
			$array['id'],			
			$array['name'],
			$array['pic_url'],
			$array['website']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "Contact";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicURL(),
			$object->getWebsite()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPicURL(),
			$object->getWebsite(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>