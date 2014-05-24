<?php
Namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SaveProduct extends Mapper implements \MVC\Domain\SaveProductFinder {

    function __construct() {
        parent::__construct();
		
		$tblSaveProduct = "shopc_save_product";
						
		$selectAllStmt 	= sprintf("select * from %s ", $tblSaveProduct);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblSaveProduct);
		$updateStmt 	= sprintf("update %s set idsave=?, `idproduct`=?, `discount`=?, `value`=? where id=?", $tblSaveProduct);
		$insertStmt 	= sprintf("insert into %s ( idsave, `idproduct`, `discount`, `value`) values(?, ?, ?, ?)", $tblSaveProduct);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblSaveProduct);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSaveProduct);
		$findByStmt 	= sprintf("select * from %s where idsave=?", $tblSaveProduct);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
									
    } 
    function getCollection( array $raw ) {return new SaveProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SaveProduct( 
			$array['id'],
			$array['idsave'],
			$array['idproduct'],
			$array['discount'],
			$array['value']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "SaveProduct";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdSave(),
			$object->getIdProduct(),
			$object->getDiscount(),
			$object->getValue()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdSave(),
			$object->getIdProduct(),
			$object->getDiscount(),
			$object->getValue(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new SaveProductCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SaveProductCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>