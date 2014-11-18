<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class PostTag extends Mapper implements \MVC\Domain\PostTagFinder {
    function __construct() {
        parent::__construct();
		
		$tblPostTag = "tbl_post_tag";
						
		$selectAllStmt 		= sprintf("select * from %s order by `order`", $tblPostTag);
		$selectStmt 		= sprintf("select * from %s where id=?", $tblPostTag);
		$updateStmt 		= sprintf("update %s set id_post=?, id_tag=?  where id=?", $tblPostTag);
		$insertStmt 		= sprintf("insert into %s ( id_post, id_tag) values(?, ?)", $tblPostTag);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblPostTag);		
		$findByPostStmt		= sprintf("select *  from %s where id_post=?", 			$tblPostTag);
		$findByLastest4Stmt	= sprintf("SELECT *  FROM %s ORDER BY id DESC LIMIT 4", 	$tblPostTag);
		
		$findByTagStmt		= sprintf("select *  from %s where id_tag=?", 			$tblPostTag);				
		$findByTagPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			WHERE id_tag=:id_tag
			ORDER BY id DESC
			LIMIT :start,:max"
		, $tblPostTag);
		
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);		
		$this->findByPostStmt 		= self::$PDO->prepare($findByPostStmt);
		$this->findByTagStmt 		= self::$PDO->prepare($findByTagStmt);
		$this->findByLastest4Stmt 	= self::$PDO->prepare($findByLastest4Stmt);
		$this->findByTagPageStmt 	= self::$PDO->prepare($findByTagPageStmt);
    } 
    function getCollection( array $raw ) {return new PostTagCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\PostTag( 
			$array['id'],
			$array['id_post'],
			$array['id_tag']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Tag";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost(),
			$object->getIdTag()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPost(),
			$object->getIdTag(),			
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPost(array $values) {
        $this->findByPostStmt->execute( $values );
        return new PostTagCollection( $this->findByPostStmt->fetchAll(), $this );
    }
	
	function findByTag(array $values) {
        $this->findByTagStmt->execute( $values );
        return new PostTagCollection( $this->findByTagStmt->fetchAll(), $this );
    }
	
	function findByLastest4(array $values) {
        $this->findByLastest4Stmt->execute( $values );
        return new PostTagCollection( $this->findByLastest4Stmt->fetchAll(), $this );
    }
	
	function findByTagPage( $values ) {
		$this->findByTagPageStmt->bindValue(':id_tag', $values[0], \PDO::PARAM_INT);
		$this->findByTagPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByTagPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByTagPageStmt->execute();
        return new PostTagCollection( $this->findByTagPageStmt->fetchAll(), $this );
    }
	
}
?>