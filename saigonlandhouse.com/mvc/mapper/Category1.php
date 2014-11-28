<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Category1 extends Mapper implements \MVC\Domain\Category1Finder {

    function __construct() {
        parent::__construct();
		
		$tblCategory1 	= "tbl_category1";
						
		$selectAllStmt 	= sprintf("SELECT * from %s order by id_category, name", $tblCategory1);
		$selectStmt 	= sprintf("SELECT * from %s where id=?", $tblCategory1);
		$updateStmt 	= sprintf("update %s set id_category=?, info=?, name=?, `order`=?, `key`=? where id=?", $tblCategory1);
		$insertStmt 	= sprintf("insert into %s ( id_category, info, name, `order`, `key`) values(?, ?, ?, ?, ?)", $tblCategory1);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCategory1);
		$findByStmt 	= sprintf("SELECT * FROM  %s WHERE id_category=? ORDER BY `order`", $tblCategory1);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblCategory1);
		$findByKeyStmt 	= sprintf("select *  from %s where id_category=? AND `key`=?", $tblCategory1);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);									
    }
	
    function getCollection( array $raw ) {return new Category1Collection( $raw, $this );}
    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\Category1( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['info'],
			$array['order'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Category1";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),			
			$object->getInfo(),
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
			$object->getIdCategory(),			
			$object->getInfo(),
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
	
	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new Category1Collection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new Category1Collection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( $values );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
}
?>