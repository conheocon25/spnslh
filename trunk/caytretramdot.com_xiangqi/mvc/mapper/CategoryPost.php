<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CategoryPost extends Mapper implements \MVC\Domain\CategoryPostFinder{

    function __construct() {
        parent::__construct();
		
		$tblCategoryPost = "bamboo100_category_post";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order` DESC", $tblCategoryPost);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblCategoryPost);
		$updateStmt 	= sprintf("update %s set name=?, `order`=?, post_count=?, `key`=? where id=?", $tblCategoryPost);
		$insertStmt 	= sprintf("insert into %s ( name, `order`, post_count, `key`) values(?, ?, ?, ?)", $tblCategoryPost);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCategoryPost);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order`, name	LIMIT :start,:max", $tblCategoryPost);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCategoryPost);		
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);							
		
		
    } 
    function getCollection( array $raw ) {return new CategoryPostCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CategoryPost( 
			$array['id'],
			$array['name'],
			$array['order'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "CategoryPost";}
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
        return new CategoryPostCollection( $this->findByPageStmt->fetchAll(), $this );
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