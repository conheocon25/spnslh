<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Supplier extends Mapper implements \MVC\Domain\SupplierFinder {

    function __construct() {
        parent::__construct();
		$tblSupplier 			= "supplier";		
        $this->selectAllStmt 	= self::$PDO->prepare("select * FROM supplier");
        $this->selectStmt 		= self::$PDO->prepare("select * FROM supplier where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update supplier set id_type=?, name=?, code=?, presentation=?, tel=?, fax=?, email=?, web=?, tax_code=?, debt_limit=?, address=?, note=?, avatar=?, enable=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into supplier (id_type, name, code, presentation, tel, fax, email, web, tax_code, debt_limit, address, note, avatar, enable) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete FROM supplier where id=?");
		$this->findByTypeStmt 	= self::$PDO->prepare("SELECT * FROM supplier WHERE id_type=? ORDER BY name");
		$this->findBySerialStmt = self::$PDO->prepare("SELECT * FROM supplier WHERE code=?");

		$findByPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_type=:id_type ORDER BY name LIMIT :start,:max", $tblSupplier);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
						 
    } 
    function getCollection( array $raw ) {return new SupplierCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Supplier( 
			$array['id'],	
			$array['id_type'],
			$array['name'],
			$array['code'],
			$array['presentation'],
			$array['tel'],
			$array['fax'],
			$array['email'],
			$array['web'],
			$array['tax_code'],			
			$array['debt_limit'],
			$array['address'],
			$array['note'],			
			$array['avatar'],
			$array['enable']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Supplier";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  	
			$object->getIdType(),
			$object->getName(),
			$object->getCode(),
			$object->getRepresent(),
			$object->getTel(),	
			$object->getFax(),	
			$object->getEmail(),			
			$object->getWeb(),
			$object->getTaxCode(),
			$object->getDebtLimit(),
			$object->getAddress(),
			$object->getNote(),			
			$object->getAvatar(),
			$object->getEnable()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdType(),
			$object->getName(),
			$object->getCode(),
			$object->getRepresent(),
			$object->getTel(),	
			$object->getFax(),	
			$object->getEmail(),				
			$object->getWeb(),
			$object->getTaxCode(),
			$object->getDebtLimit(),
			$object->getAddress(),
			$object->getNote(),			
			$object->getAvatar(),
			$object->getEnable(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByType($values) {		
        $this->findByTypeStmt->execute( $values );
        return new SupplierCollection( $this->findByTypeStmt->fetchAll(), $this );
    }
			
	function findByCard( $values ){
		$this->findBySerialStmt->execute( $values );
        $array = $this->findBySerialStmt->fetch();
        $this->findBySerialStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
		
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':id_type', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SupplierCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>