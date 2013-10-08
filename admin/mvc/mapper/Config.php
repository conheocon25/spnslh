<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Config extends Mapper implements \MVC\Domain\ConfigFinder {

    function __construct() {
        parent::__construct();
		$tblConfig = "tbl_config";
		
		$selectAllStmt = sprintf("select * from %s", $tblConfig);
		$selectStmt = sprintf("select *  from %s where id=?", $tblConfig);
		$updateStmt = sprintf("update %s set param=?, value=? where id=?", $tblConfig);
		$insertStmt = sprintf("insert into %s ( param, value) values(?, ?)", $tblConfig);
		$deleteStmt = sprintf("delete from %s where id=?", $tblConfig);		
		$findByNameStmt = sprintf("select *  from %s where param=?", $tblConfig);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblConfig);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByNameStmt = self::$PDO->prepare($findByNameStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
    }
	
    function getCollection( array $raw ) {return new ConfigCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Config(
			$array['id'],
			$array['param'],
			$array['value']			
		);
        return $obj;
    }

    protected function targetClass() {return "Config";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getParam(),			
			$object->getValue()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getParam(),
			$object->getValue(),			
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByName( $Param ){
        $this->findByNameStmt->execute( array( $Param ) );
        $array = $this->findByNameStmt->fetch( ); 
        $this->findByNameStmt->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ConfigCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>