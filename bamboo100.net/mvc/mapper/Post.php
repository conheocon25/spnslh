<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Post extends Mapper implements \MVC\Domain\PostFinder {

    function __construct() {
        parent::__construct();
				
		$tblPost = "tbl_Post";
		
		$selectAllStmt 	= sprintf("select * from %s ORDER BY date_time DESC", $tblPost);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblPost);
		$updateStmt 	= sprintf("update %s set id_category=?, author=?, date_time=?, content=?, title=?, type=?, `key`=? where id=?", $tblPost);
		$insertStmt 	= sprintf("insert into %s ( id_category, author, date_time, content, title, type, `key`) values(?, ?, ?, ?, ?, ?, ?)", $tblPost);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblPost);
		
		$findByUserStmt = sprintf("select *  from %s where id_user=? ORDER BY date_time DESC", $tblPost);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblPost);
			
		$findByCategoryDateStmt = sprintf(
			"select *  
			from %s 
			where id_category=? AND date<=?
			ORDER BY type DESC, date DESC LIMIT 10"
		, $tblPost);
			
		$findByCategoryPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			WHERE id_category=:id_category
			ORDER BY date desc			
			LIMIT :start,:max"
		, $tblPost);		
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY date desc LIMIT :start,:max" , $tblPost);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByUserStmt 	= self::$PDO->prepare($findByUserStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
				
		$this->findByCategoryDateStmt = self::$PDO->prepare($findByCategoryDateStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByCategoryPageStmt = self::$PDO->prepare($findByCategoryPageStmt);

    } 
    function getCollection( array $raw ) {return new PostCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Post( 
			$array['id'],
			$array['id_user'],			
			$array['date_time'],			
			$array['title'],
			$array['content'],			
			$array['key']
		);				
        return $obj;
    }

    protected function targetClass() {return "Post";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getDateTime(),			
			$object->getTitle(),
			$object->getContent(),			
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),			
			$object->getDateTime(),			
			$object->getTitle(),
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
	
	function findByUser( $values ){
        $this->findByUserStmt->execute( $values );
        return new PostCollection( $this->findByUserStmt->fetchAll(), $this);
    }
		
	function findByLimit( $values ){
        $this->findByLimitStmt->execute( $values );
        return new PostCollection( $this->findByLimitStmt->fetchAll(), $this);
    }
		
	function findByCategoryDate( $values ){
        $this->findByCategoryDateStmt->execute( $values );
        return new PostCollection( $this->findByCategoryDateStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PostCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	function findByCategoryPage( $values ) {
		$this->findByCategoryPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new PostCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
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