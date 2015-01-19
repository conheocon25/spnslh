<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CBM extends Mapper implements \MVC\Domain\CBMFinder{

    function __construct() {
        parent::__construct();
				
		$tblCBM 			= "bamboo100_cbm";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY id", $tblCBM);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblCBM);
		$updateStmt 		= sprintf("update %s set id_category=?, name=?, `time`=?, move_start=?, move_end=?, `key`=? where id=?", $tblCBM);
		$insertStmt 		= sprintf("insert into %s ( id_category, name, time, move_start, move_end, key) values(?, ?, ?, ?, ?, ?)", $tblCBM);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblCBM);
		$findByStmt 		= sprintf("select *  from %s where `id_category`=?", $tblCBM);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblCBM);
		$findByPageStmt 	= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblCBM);
						
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);		
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
	}
	
    function getCollection( array $raw ) {return new CBMCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CBM( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['time'],
			$array['move_start'],
			$array['move_end'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "CBM";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getTime(),
			$object->getMoveStart(),
			$object->getMoveEnd(),
			$object->getKey()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),			
			$object->getTime(),
			$object->getMoveStart(),
			$object->getMoveEnd(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new CBMCollection( $this->findByStmt->fetchAll(), $this);
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
			
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CBMCollection( $this->findByPageStmt->fetchAll(), $this );
    }
			
}
?>