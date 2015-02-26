<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Store extends Mapper implements \MVC\Domain\StoreFinder {

    function __construct() {
        parent::__construct();
		$tblStore 			= "tbl_store";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from tbl_store");
        $this->selectStmt 		= self::$PDO->prepare("select * from tbl_store where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update tbl_store set name=?, note=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into tbl_store (name, note) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from tbl_store where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblStore);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new StoreCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Store( 
			$array['id'],  
			$array['name'],			
			$array['note']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "Store";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getName(),			
			$object->getNote()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),			
			$object->getNote(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new StoreCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>