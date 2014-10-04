<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Video extends Mapper implements \MVC\Domain\VideoFinder {

    function __construct() {
        parent::__construct();
		$tblVideo = "res_video";
						
		$selectAllStmt = sprintf("select * from %s", $tblVideo);
		$selectStmt = sprintf("select * from %s where id=?", $tblVideo);
		$updateStmt = sprintf("update %s set 				
				`name`=?, 
				`date`=?,
				`note`=?,
				`url`=?,
				`key`=? 
			where id=?", $tblVideo);
			
		$insertStmt = sprintf("insert into %s (`name`, `date`, `note`, `url`, `key`) 
						values( ?, ?, ?, ?, ?)", $tblVideo);
		$deleteStmt = sprintf("delete from %s where id=?", $tblVideo);
		$findByStmt = sprintf("select * from %s where id_album=?", $tblVideo);
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s							
							LIMIT :start,:max
				", $tblVideo);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblVideo);		
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new VideoCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Video( 
			$array['id'],
			$array['name'],
			$array['date'],
			$array['note'],
			$array['url'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass(){return "Video";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(			
			$object->getName(),
			$object->getDate(),
			$object->getNote(),
			$object->getURL(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getName(),
			$object->getDate(),
			$object->getNote(),
			$object->getURL(),
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
        return new VideoCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ){
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByPage( $values ){		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new VideoCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>