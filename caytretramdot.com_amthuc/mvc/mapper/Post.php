<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Post extends Mapper implements \MVC\Domain\PostFinder {
    function __construct() {
        parent::__construct();				
		$tblPost 		= "tbl_post";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblPost);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblPost);
		$updateStmt 	= sprintf("update %s set id_course=?, title=?, `datetime_created`=?, `datetime_updated`=?, content=?, `key`=? where id=?", $tblPost);
		$insertStmt 	= sprintf("insert into %s ( id_course, title, `datetime_created`, datetime_updated, content, `key`) values(?, ?, ?, ?, ?, ?)", $tblPost);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPost);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblPost);

		$findByStmt 	= sprintf("select *  from %s where id_course=:id_course order by `datetime_created` DESC", $tblPost);
				
		$searchByTitleStmt 		= sprintf("select *  from %s where `title` like :title", $tblPost);
		$searchByTitlePageStmt 	= sprintf("select *  from %s where `title` like :title LIMIT :start,:max", $tblPost);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);				
		$this->searchByTitleStmt 	= self::$PDO->prepare($searchByTitleStmt);
		$this->searchByTitlePageStmt= self::$PDO->prepare($searchByTitlePageStmt);		
    } 
    function getCollection( array $raw ) {return new PostCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Post( 
			$array['id'],
			$array['id_course'],
			$array['title'],
			$array['datetime_created'],
			$array['datetime_updated'],
			$array['content'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "Post";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCourse(),
			$object->getTitle(),			
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getContent(),
			$object->getKey()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCourse(),
			$object->getTitle(),
			$object->getDateTimeCreated(),
			$object->getDateTimeUpdated(),
			$object->getContent(),						
			$object->getKey(),			
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
	
	function searchByTitle( $values ) {		
		$this->searchByTitleStmt->bindValue(':title', 	"%".$values[0]."%", \PDO::PARAM_STR);
		$this->searchByTitleStmt->execute();
        return new PostCollection( $this->searchByTitleStmt->fetchAll(), $this );
    }
	
	function searchByTitlePage( $values ) {
		
		$this->searchByTitlePageStmt->bindValue(':title', "%".$values[0]."%", \PDO::PARAM_STR);
		$this->searchByTitlePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->searchByTitlePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->searchByTitlePageStmt->execute();
        return new PostCollection( $this->searchByTitlePageStmt->fetchAll(), $this );
    }
	
	function findBy( $values ) {		
		$this->findByStmt->bindValue(':id_course', 	$values[0], \PDO::PARAM_INT);
		$this->findByStmt->execute();
        return new PostCollection( $this->findByStmt->fetchAll(), $this );
    }
					
}
?>