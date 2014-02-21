<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CSet extends Mapper implements \MVC\Domain\CSetFinder {

    function __construct() {
        parent::__construct();
		
		$tblCSet 		= "tbl_cset";		
		$selectAllStmt 	= sprintf("select * from %s", $tblCSet);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCSet);
		$updateStmt 	= sprintf("update %s set id_cbook=?, name=?, content=?, count=?, `key`=? where id=?", $tblCSet);
		$insertStmt 	= sprintf("insert into %s ( id_cbook, name, content,  count, `key`) values(?, ?, ?, ?, ?)", $tblCSet);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCSet);
				
		$findByBookStmt = sprintf("select *  from %s where id_cbook=?", $tblCSet);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCSet);									
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY date desc LIMIT :start,:max" , $tblCSet);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByBookStmt 	= self::$PDO->prepare($findByBookStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
						
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);		

    } 
    function getCollection( array $raw ) {return new CSetCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CSet(
			$array['id'],
			$array['id_cbook'],
			$array['name'],
			$array['content'],
			$array['count'],
			$array['key']
		);		
        return $obj;
    }

    protected function targetClass() {return "CSet";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCBook(),
			$object->getName(),
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
			$object->getIdCBook(),			
			$object->getName(),
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
	
	function findByBook( $values ){
        $this->findByBookStmt->execute( $values );
        return new CSetCollection( $this->findByBookStmt->fetchAll(), $this);
    }
			
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CSetCollection( $this->findByPageStmt->fetchAll(), $this );
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