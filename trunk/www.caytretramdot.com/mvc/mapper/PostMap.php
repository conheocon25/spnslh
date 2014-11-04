<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PostMap extends Mapper implements \MVC\Domain\PostMapFinder {
    function __construct() {
        parent::__construct();
		
		$tblPostMap = "bamboo100_post_map";
						
		$selectAllStmt 		= sprintf("select * from %s", $tblPostMap);
		$selectStmt 		= sprintf("select * from %s where id=?", $tblPostMap);
		$updateStmt 		= sprintf("update %s set id_post=?, name=?, latitude=?, longitude=?  where id=?", $tblPostMap);
		$insertStmt 		= sprintf("insert into %s ( id_post, name, latitude, longitude) values(?, ?, ?, ?)", $tblPostMap);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblPostMap);		
		$findByPostStmt		= sprintf("select *  from %s where id_post=?", $tblPostMap);
		
        $this->selectAllStmt= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 	= self::$PDO->prepare($selectStmt);
        $this->updateStmt 	= self::$PDO->prepare($updateStmt);
        $this->insertStmt 	= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 	= self::$PDO->prepare($deleteStmt);		
		$this->findByPostStmt= self::$PDO->prepare($findByPostStmt);
    } 
    function getCollection( array $raw ) {return new PostMapCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\PostMap( 
			$array['id'],
			$array['id_post'],
			$array['name'],
			$array['latitude'],
			$array['longitude']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "PostMap";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost(),
			$object->getName(),
			$object->getLatitude(),
			$object->getLongitude()	
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost(),
			$object->getName(),
			$object->getLatitude(),
			$object->getLongitude(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPost(array $values) {
        $this->findByPostStmt->execute( $values );
        return new PostMapCollection( $this->findByPostStmt->fetchAll(), $this );
    }
	
}
?>