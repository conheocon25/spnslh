<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Customer extends Mapper implements \MVC\Domain\CustomerFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare( 
                            "select * from demo1_customer");
        $this->selectStmt = self::$PDO->prepare( 
                            "select * from demo1_customer where id=?");
        $this->updateStmt = self::$PDO->prepare( 
                            "update demo1_customer set name=?, type=?, card=?, phone=?, address=?, note=?, discount=? where id=?");
        $this->insertStmt = self::$PDO->prepare( 
                            "insert into demo1_customer (name, type, card, phone, address, note, discount) 
							values( ?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt = self::$PDO->prepare( 
                            "delete from demo1_customer where id=?");
		$this->findByPositionStmt = self::$PDO->prepare("
						SELECT id 
						FROM demo1_customer
						WHERE idlocation=?
						LIMIT ?,1
						ORDER By id asc
		");
		$this->findByCardStmt = self::$PDO->prepare("select * from demo1_customer where card=?");
		
		$tblCustomer = "demo1_customer";
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblCustomer);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new CustomerCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Customer( 
			$array['id'],  
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
	
	function findByPostion($values) {		
        $str = "SELECT id FROM demo1_customer ORDER BY id LIMIT ". $values[0] .",1";		
		$this->findByPositionStmt = self::$PDO->prepare($str);
        $this->findByPositionStmt->execute($values);
		$result = $this->findByPositionStmt->fetchAll();
        return $result[0][0];
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
	
	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CustomerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>