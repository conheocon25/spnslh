<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Customer extends Mapper implements \MVC\Domain\CustomerFinder {

    function __construct() {
        parent::__construct();
		$tblCustomer 			= "customer";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update customer set id_customer_group=?, name=?, tel=?, fax=?, email=?, web=?, tax_code=?, debt_limit=?, address=?, note=?, visible=?, serial=?, avatar=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into customer (id_customer_group, name, tel, fax, email, web, tax_code, debt_limit, address, note, visible, serial, avatar) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer where id=?");
		$this->findByGroupStmt 	= self::$PDO->prepare("SELECT * FROM customer WHERE id_customer_group=? ORDER BY name");
		$this->findByNormalStmt = self::$PDO->prepare("SELECT * FROM customer WHERE type>0 ORDER By type, name");
		$this->findBySerialStmt = self::$PDO->prepare("select * from customer where serial=?");
		$this->findByNameStmt 	= self::$PDO->prepare("select * from customer where name like :name ORDER BY name LIMIT 12");

		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY type, name LIMIT :start,:max", $tblCustomer);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
		$findByGroupPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_customer_group=:id_customer_group LIMIT :start,:max", $tblCustomer);
		$this->findByGroupPageStmt 	= self::$PDO->prepare($findByGroupPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new CustomerCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Customer( 
			$array['id'],
			$array['id_customer_group'],  
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
	
    protected function targetClass() {        
		return "Customer";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdGroup(),
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
			$object->getIdGroup(),
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
        return new CustomerCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByNormal($values) {		
        $this->findByNormalStmt->execute( $values );
        return new CustomerCollection( $this->findByNormalStmt->fetchAll(), $this );
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
	
	function findByGroupPage( $values ) {
		$this->findByGroupPageStmt->bindValue(':id_customer_group', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->execute();
        return new CustomerCollection( $this->findByGroupPageStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CustomerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByName( $value ) {
		$this->findByNameStmt->bindValue(':name', $value."%", \PDO::PARAM_STR);
		$this->findByNameStmt->execute();
        return new CustomerCollection( $this->findByNameStmt->fetchAll(), $this );
    }	
}
?>