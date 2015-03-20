<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Supplier extends Mapper implements \MVC\Domain\SupplierFinder {

    function __construct() {
        parent::__construct();
		$tblSupplier 			= "supplier";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * FROM supplier");
        $this->selectStmt 		= self::$PDO->prepare("select * FROM supplier where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update Supplier set name=?, tel=?, fax=?, email=?, web=?, tax_code=?, debt_limit=?, address=?, note=?, visible=?, serial=?, avatar=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into supplier (name, tel, fax, email, web, tax_code, debt_limit, address, note, visible, serial, avatar) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete FROM supplier where id=?");
		$this->findByGroupStmt 	= self::$PDO->prepare("SELECT * FROM supplier WHERE id_Supplier_group=? ORDER BY name");
		$this->findByNormalStmt = self::$PDO->prepare("SELECT * FROM supplier WHERE type>0 ORDER By type, name");
		$this->findBySerialStmt = self::$PDO->prepare("SELECT * FROM supplier WHERE serial=?");

		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblSupplier);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
						 
    } 
    function getCollection( array $raw ) {return new SupplierCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Supplier( 
			$array['id'],		
			$array['name'],
			$array['tel'],
			$array['fax'],
			$array['email'],
			$array['web'],
			$array['tax_code'],			
			$array['debt_limit'],
			$array['address'],
			$array['note'],
			$array['visible'],
			$array['serial'],
			$array['avatar']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Supplier";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  	
			$object->getName(),
			$object->getTel(),	
			$object->getFax(),	
			$object->getEmail(),			
			$object->getWeb(),
			$object->getTaxCode(),
			$object->getDebtLimit(),
			$object->getAddress(),
			$object->getNote(),
			$object->getVisible(),
			$object->getSerial(),
			$object->getAvatar()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(			
			$object->getName(),
			$object->getTel(),	
			$object->getFax(),	
			$object->getEmail(),				
			$object->getWeb(),
			$object->getTaxCode(),
			$object->getDebtLimit(),
			$object->getAddress(),
			$object->getNote(),
			$object->getVisible(),
			$object->getSerial(),
			$object->getAvatar(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByGroup($values) {		
        $this->findByGroupStmt->execute( $values );
        return new SupplierCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByNormal($values) {		
        $this->findByNormalStmt->execute( $values );
        return new SupplierCollection( $this->findByNormalStmt->fetchAll(), $this );
    }
	
	function findByCard( $values ) {	
		$this->findBySerialStmt->execute( $values );
        $array = $this->findBySerialStmt->fetch();
        $this->findBySerialStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
		
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SupplierCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>