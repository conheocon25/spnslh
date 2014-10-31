<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Post extends Mapper implements \MVC\Domain\PostFinder {
    function __construct() {
        parent::__construct();
				
		$tblPost = "res_post";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblPost);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblPost);
		$updateStmt 	= sprintf("update %s set title=?, content=?, author=?, `time`=?, `count`=?, `key`=?, `viewed`=?, `liked`=? where id=?", $tblPost);
		$insertStmt 	= sprintf("insert into %s ( title, content, author, `time`, `count`, `key`, `viewed`, `liked`) values(?, ?, ?, ?, ?, ?, ?, ?)", $tblPost);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPost);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblPost);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);

    } 
    function getCollection( array $raw ) {return new PostCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Post( 
			$array['id'],
			$array['title'],
			$array['content'],
			$array['author'],
			$array['time'],
			$array['count'],
			$array['key'],
			$array['viewed'],
			$array['liked']
		);
        return $obj;
    }

    protected function targetClass() {return "Post";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getTitle(),
			$object->getContent(),
			$object->getAuthor(),
			$object->getTime(),
			$object->getCount(),
			$object->getKey(),
			$object->getViewed(),
			$object->getLiked()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getTitle(),
			$object->getContent(),
			$object->getAuthor(),
			$object->getTime(),
			$object->getCount(),
			$object->getKey(),
			$object->getViewed(),
			$object->getLiked(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
		
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