<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class UserTag extends Mapper implements \MVC\Domain\UserTagFinder {

    function __construct() {
        parent::__construct();
		
		$tblUserTag = "bamboo100_user_tag";
						
		$selectAllStmt 				= sprintf("select * from %s order by `post_count` DESC, name", $tblUserTag);
		$selectStmt 				= sprintf("select * from %s where id=?", $tblUserTag);
		$updateStmt 				= sprintf("update %s set id_user=?, `id_tag`=?, post_count=? where id=?", $tblUserTag);
		$insertStmt 				= sprintf("insert into %s ( id_user, id_tag, post_count) values(?, ?, ?)", $tblUserTag);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblUserTag);
		$findByPageStmt 			= sprintf("SELECT * FROM  %s ORDER BY `post_count` DESC	LIMIT :start,:max", $tblUserTag);
		$findByUserStmt 			= sprintf("SELECT * FROM  %s WHERE id_user=? ORDER BY `post_count` DESC", $tblUserTag);
		$findByUserTagStmt 			= sprintf("SELECT * FROM  %s WHERE id_user=? AND id_tag=?", $tblUserTag);
		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByUserStmt 		= self::$PDO->prepare($findByUserStmt);
		$this->findByUserTagStmt 	= self::$PDO->prepare($findByUserTagStmt);		
    }
	
    function getCollection( array $raw ) {return new UserTagCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\UserTag( 
			$array['id'],
			$array['id_user'],
			$array['id_tag'],
			$array['post_count']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "UserTag";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getIdTag(),
			$object->getPostCount()			
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
        return new UserTagCollection( $this->findByPageStmt->fetchAll(), $this );
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
	
	function findByUser(array $values) {
        $this->findByUserStmt->execute( $values );
        return new UserTagCollection( $this->findByUserStmt->fetchAll(), $this );
    }
	
	function findByUserTag(array $values) {
        $this->findByUserTagStmt->execute( $values );
        return new UserTagCollection( $this->findByUserTagStmt->fetchAll(), $this );
    }
	
}
?>