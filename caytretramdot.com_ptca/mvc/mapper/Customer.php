<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Customer extends Mapper implements \MVC\Domain\CustomerFinder {

    function __construct() {
        parent::__construct();
		$tblCustomer 			= "tbl_customer";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from tbl_customer");
        $this->selectStmt 		= self::$PDO->prepare("select * from tbl_customer where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update tbl_customer set id_category=?, name=?, type=?, card=?, phone=?, address=?, note=?, discount=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into tbl_customer (id_category, name, type, card, phone, address, note, discount) values( ?, ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from tbl_customer where id=?");
		$this->findByCategoryStmt = self::$PDO->prepare("SELECT * FROM tbl_customer WHERE id_category=? ORDER By type, name");
		$this->findByNormalStmt = self::$PDO->prepare("SELECT * FROM tbl_customer WHERE type>0 ORDER By type, name");
		$this->findByCardStmt 	= self::$PDO->prepare("select * from tbl_customer where card=?");

		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY type, name LIMIT :start,:max", $tblCustomer);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
		$findByCategoryPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_category=:id_category LIMIT :start,:max", $tblCustomer);
		$this->findByCategoryPageStmt 	= self::$PDO->prepare($findByCategoryPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new CustomerCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Customer( 
			$array['id'],  
			$array['id_category'],  
			$array['name'],
			$array['type'],
			$array['card'],
			$array['phone'],
			$array['address'],
			$array['note'],
			$array['discount']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "Customer";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdCategory(),
			$object->getName(),
			$object->getType(),	
			$object->getCard(),	
			$object->getPhone(),	
			$object->getAddress(),	
			$object->getNote(),
			$object->getDiscount()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCategory(),
			$object->getName(),
			$object->getType(),	
			$object->getCard(),	
			$object->getPhone(),	
			$object->getAddress(),
			$object->getNote(),
			$object->getDiscount(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByCategory($values) {		
        $this->findByCategoryStmt->execute( $values );
        return new CustomerCollection( $this->findByCategoryStmt->fetchAll(), $this );
    }
	
	function findByNormal($values) {		
        $this->findByNormalStmt->execute( $values );
        return new CustomerCollection( $this->findByNormalStmt->fetchAll(), $this );
    }
	
	function findByCard( $values ) {	
		$this->findByCardStmt->execute( $values );
        $array = $this->findByCardStmt->fetch();
        $this->findByCardStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByCategoryPage( $values ) {
		$this->findByCategoryPageStmt->bindValue(':id_category', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new CustomerCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CustomerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>