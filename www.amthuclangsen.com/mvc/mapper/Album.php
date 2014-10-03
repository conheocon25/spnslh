<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Album extends Mapper implements \MVC\Domain\AlbumFinder {

    function __construct() {
        parent::__construct();
		
		$tblAlbum = "res_album";
						
		$selectAllStmt 	= sprintf("SELECT * from %s order by `order`", $tblAlbum);
		$selectStmt 	= sprintf("SELECT * from %s where id=?", $tblAlbum);
		$updateStmt 	= sprintf("update %s set `date`=?, `name`=?, `note`=?, `order`=?, `key`=? where id=?", $tblAlbum);
		$insertStmt 	= sprintf("insert into %s ( `date`, name, note, `order`, `key`) values(?, ?, ?, ?, ?)", $tblAlbum);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblAlbum);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblAlbum);
		$findByKeyStmt 	= sprintf("SELECT *  from %s where `key`=?", $tblAlbum);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new AlbumCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Album( 		
			$array['id'],
			$array['date'],
			$array['name'],
			$array['note'],
			$array['order'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Album";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getDate(),
			$object->getName(),
			$object->getNote(),
			$object->getOrder(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getDate(),
			$object->getName(),
			$object->getNote(),
			$object->getOrder(),
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
        return new EmployeeCollection( $this->findByPageStmt->fetchAll(), $this );
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
}
?>