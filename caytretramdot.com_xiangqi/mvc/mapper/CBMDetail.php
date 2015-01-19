<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CBMDetail extends Mapper implements \MVC\Domain\CBMDetailFinder{

    function __construct() {
        parent::__construct();
				
		$tblCBMDetail 		= "bamboo100_cbm_detail";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY id", $tblCBMDetail);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblCBMDetail);
		$updateStmt 		= sprintf("update %s set id_cbm=?, move=?, name1=?, state1=?, name2=?, state2=? where id=?", $tblCBMDetail);
		$insertStmt 		= sprintf("insert into %s ( id_cbm, move, name1, state1, name2, state2) values(?, ?, ?, ?, ?, ?)", $tblCBMDetail);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblCBMDetail);
		$deleteByStmt 		= sprintf("delete from %s where id_cbm=?", $tblCBMDetail);
		$findByStmt 		= sprintf("SELECT * FROM  %s WHERE id_cbm=?", $tblCBMDetail);
												
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);		
		$this->deleteByStmt 	= self::$PDO->prepare($deleteByStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);		
	}
	
    function getCollection( array $raw ) {return new CBMDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CBMDetail( 
			$array['id'],
			$array['id_cbm'],
			$array['move'],
			$array['name1'],
			$array['state1'],
			$array['name2'],
			$array['state2']			
		);
        return $obj;
    }

    protected function targetClass() {return "CBMDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCBM(),
			$object->getMove(),
			$object->getName1(),
			$object->getState1(),
			$object->getName2(),
			$object->getState2()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCBM(),
			$object->getMove(),
			$object->getName1(),
			$object->getState1(),
			$object->getName2(),
			$object->getState2(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteBy(array $values) {return $this->deleteByStmt->execute( $values );}
			
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new CBMDetailCollection( $this->findByStmt->fetchAll(), $this);
    }			
}
?>