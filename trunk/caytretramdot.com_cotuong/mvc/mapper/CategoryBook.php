<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CategoryBook extends Mapper implements \MVC\Domain\CategoryBookFinder{

    function __construct() {
        parent::__construct();
		
		$tblCategoryBook = "tbl_category_book";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblCategoryBook);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblCategoryBook);
		$updateStmt 	= sprintf("update %s set name=?, `order`=?, `key`=? where id=?", $tblCategoryBook);
		$insertStmt 	= sprintf("insert into %s ( name, `order`, `key`) values(?, ?, ?)", $tblCategoryBook);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCategoryBook);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order`, name	LIMIT :start,:max", $tblCategoryBook);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCategoryBook);		
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);							
		
		
    } 
    function getCollection( array $raw ) {return new CategoryBookCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CategoryBook( 
			$array['id'],
			$array['name'],
			$array['order'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "CategoryBook";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getOrder(),			
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
        return new CategoryBookCollection( $this->findByPageStmt->fetchAll(), $this );
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