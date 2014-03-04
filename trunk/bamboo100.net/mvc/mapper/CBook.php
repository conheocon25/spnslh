<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CBook extends Mapper implements \MVC\Domain\CBookFinder {

    function __construct() {
        parent::__construct();
		
		$tblCBook 		= "tbl_cbook";		
		$selectAllStmt 	= sprintf("select * from %s ORDER BY date_time DESC", $tblCBook);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCBook);
		$updateStmt 	= sprintf("update %s set id_user=?, author=?, date_time=?, title=?, content=?, count=?, `key`=? where id=?", $tblCBook);
		$insertStmt 	= sprintf("insert into %s ( id_user, author, date_time,  title, content, count, `key`) values(?, ?, ?, ?, ?, ?, ?)", $tblCBook);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCBook);
		
		$findLikeKeyStmt= sprintf("select *  from %s where `key` like :term LIMIT 12", $tblCBook);
		$findByTopStmt 	= sprintf("select *  from %s ORDER BY `count` DESC LIMIT 12", $tblCBook);
		$findByUserStmt = sprintf("select *  from %s where id_user=? ORDER BY date_time DESC", $tblCBook);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCBook);									
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY date desc LIMIT :start,:max" , $tblCBook);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findLikeKeyStmt 	= self::$PDO->prepare($findLikeKeyStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		$this->findByTopStmt 	= self::$PDO->prepare($findByTopStmt);
		$this->findByUserStmt 	= self::$PDO->prepare($findByUserStmt);
							
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);		

    } 
    function getCollection( array $raw ) {return new CBookCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CBook( 
			$array['id'],
			$array['id_user'],			
			$array['author'],
			$array['date_time'],			
			$array['title'],
			$array['content'],			
			$array['count'],			
			$array['key']
		);				
        return $obj;
    }

    protected function targetClass() {return "CBook";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),
			$object->getAuthor(),
			$object->getDateTime(),
			$object->getTitle(),
			$object->getContent(),
			$object->getCount(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdUser(),			
			$object->getAuthor(),
			$object->getDateTime(),			
			$object->getTitle(),
			$object->getContent(),			
			$object->getCount(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByUser( $values ){
        $this->findByUserStmt->execute( $values );
        return new CBookCollection( $this->findByUserStmt->fetchAll(), $this);
    }
	
	function findByTop( $values ){
        $this->findByTopStmt->execute( $values );
        return new CBookCollection( $this->findByTopStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CBookCollection( $this->findByPageStmt->fetchAll(), $this );
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
	
	function findLikeKey( $values ) {		
		$this->findLikeKeyStmt->bindValue(':term', "%".$values[0]."%", \PDO::PARAM_STR);
		$this->findLikeKeyStmt->execute();
        return new CBookCollection( $this->findLikeKeyStmt->fetchAll(), $this );
    }
}
?>