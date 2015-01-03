<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PostLinked extends Mapper implements \MVC\Domain\PostLinkedFinder {
    function __construct() {
        parent::__construct();
		
		$tblPostLinked = "bamboo100_post_linked";
						
		$selectAllStmt 		= sprintf("select * from %s order by `order`", $tblPostLinked);
		$selectStmt 		= sprintf("select * from %s where id=?", $tblPostLinked);
		$updateStmt 		= sprintf("update %s set id_post1=?, id_post2=?, id_linked=?  where id=?", $tblPostLinked);
		$insertStmt 		= sprintf("insert into %s ( id_post1, id_post2, id_linked) values(?, ?, ?)", $tblPostLinked);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblPostLinked);		
		$findByPostStmt		= sprintf("select *  from %s where id_post1=?", $tblPostLinked);
				
		$findByPostLinkedStmt= sprintf("select *  from %s where id_post1=? and id_linked=?", $tblPostLinked);
				
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);		
		$this->findByPostStmt 		= self::$PDO->prepare($findByPostStmt);
		$this->findByPostLinkedStmt = self::$PDO->prepare($findByPostLinkedStmt);
    } 
    function getCollection( array $raw ) {return new PostLinkedCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\PostLinked( 
			$array['id'],
			$array['id_post1'],
			$array['id_post2'],
			$array['id_linked']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Linked";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost1(),
			$object->getIdPost2(),
			$object->getIdLinked()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost1(),
			$object->getIdPost2(),
			$object->getIdLinked(),			
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPost(array $values) {
        $this->findByPostStmt->execute( $values );
        return new PostLinkedCollection( $this->findByPostStmt->fetchAll(), $this );
    }
	
	function findByPostLinked(array $values){
        $this->findByPostLinkedStmt->execute( $values );
        return new PostLinkedCollection( $this->findByPostLinkedStmt->fetchAll(), $this );
    }
	
}
?>