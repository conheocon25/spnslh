<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Good extends Mapper implements \MVC\Domain\GoodFinder {

    function __construct() {
        parent::__construct();
		$tblGood 				= "good";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from good order by id_group, name");
        $this->selectStmt 		= self::$PDO->prepare("select * from good where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update good set id_group=?, name=?, price_import=?, price_sale=?, unit=?, vat=?, note=?, visible=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into good (id_group, name, price_import, price_sale, unit, vat, note, visible) values(?,?,?,?,?,?,?,?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from good where id=?");
		
		$findByGroupStmt		= sprintf("select * from %s where id_group=?", $tblGood);
		$findByGroupPageStmt 	= sprintf("SELECT * FROM  %s WHERE id_group=:id_group LIMIT :start,:max", $tblGood);								 
		
		$this->findByGroupStmt 	= self::$PDO->prepare($findByGroupStmt);
		$this->findByGroupPageStmt 		= self::$PDO->prepare($findByGroupPageStmt);
    } 
    function getCollection( array $raw ) {return new GoodCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Good( 
			$array['id'],  
			$array['id_group'],
			$array['name'],
			$array['price_import'],
			$array['price_sale'],
			$array['unit'],
			$array['vat'],
			$array['note'],
			$array['visible']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "Good";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getPriceImport(),
			$object->getPriceSale(),
			$object->getUnit(),
			$object->getVat(),
			$object->getNote(),
			$object->getVisible()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getPriceImport(),
			$object->getPriceSale(),
			$object->getUnit(),
			$object->getVat(),
			$object->getNote(),
			$object->getVisible(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	
	function findByGroup( array $values ) {
		$this->findByGroupStmt->execute($values);
        return new GoodCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByGroupPage( $values ) {
		$this->findByGroupPageStmt->bindValue(':id_group', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->execute();
        return new GoodCollection( $this->findByGroupPageStmt->fetchAll(), $this );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
}
?>