<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Tag extends Mapper implements \MVC\Domain\TagFinder {

    function __construct() {
        parent::__construct();
		
		$tblTag = "bamboo100_tag";
						
		$selectAllStmt 	= sprintf("select * from %s order by `post_count` DESC, name", $tblTag);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblTag);
		$updateStmt 	= sprintf("update %s set name=?, `order`=?, post_count=?, `key`=? where id=?", $tblTag);
		$insertStmt 	= sprintf("insert into %s ( name, `order`, post_count, `key`) values(?, ?, ?, ?)", $tblTag);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblTag);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order`, name	LIMIT :start,:max", $tblTag);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblTag);		
		$findBypost_countStmt 		= sprintf("SELECT * FROM  %s WHERE post_count=? order by `order`, name", $tblTag);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);							
		$this->findBypost_countStmt 	= self::$PDO->prepare($findBypost_countStmt);
		
    } 
    function getCollection( array $raw ) {return new TagCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Tag( 
			$array['id'],
			$array['name'],
			$array['order'],
			$array['post_count'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Tag";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),
			$object->getPostCount(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),
			$object->getPostCount(),
			$object->getKey(),
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
        return new TagCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByPostCount(array $values) {
        $this->findByPostCountStmt->execute( $values );
        return new TagCollection( $this->findByPostCountStmt->fetchAll(), $this );
    }
	
}
?>