<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Book extends Mapper implements \MVC\Domain\BookFinder{

    function __construct() {
        parent::__construct();
				
		$tblBook = "bamboo100_book";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY `order`", $tblBook);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblBook);
		$updateStmt 		= sprintf("update %s set name=?, `order`=?, `key`=? where id=?", $tblBook);
		$insertStmt 		= sprintf("insert into %s ( name, `order`, `key`) values(?, ?, ?)", $tblBook);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblBook);				
		$findByStmt 		= sprintf("select *  from %s where id_category=? ORDER BY `order`", $tblBook);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblBook);
		$findByPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `order` LIMIT :start,:max", $tblBook);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 	= self::$PDO->prepare($selectStmt);
        $this->updateStmt 	= self::$PDO->prepare($updateStmt);
        $this->insertStmt 	= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 	= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 	= self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new BookCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Book( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['order'],
			$array['url']
		);
        return $obj;
    }

    protected function targetClass() { return "Book";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getOrder(),
			$object->getURL()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getOrder(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new BookCollection( $this->findByStmt->fetchAll(), $this);
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
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BookCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>