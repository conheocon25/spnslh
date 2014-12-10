<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Branch extends Mapper implements \MVC\Domain\BranchFinder {

    function __construct() {
        parent::__construct();
		
		$tblBranch = "tbl_branch";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblBranch);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblBranch);
		$updateStmt 	= sprintf("update %s set 
				name=?, 
				address=?,
				x=?,
				y=?,
				phone1=?, 
				phone2=?, 
				email1=?, 
				email2=?, 
				`order`=?,
				`logo`=?
			where id=?", $tblBranch);
		$insertStmt 	= sprintf("insert into %s ( 
				name, 
				address, 
				x, 
				y, 
				phone1, 
				phone2, 
				email1, 
				email2, 
				`order`,
				`logo`) 
			values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblBranch);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblBranch);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblBranch);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblBranch);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new BranchCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Branch( 
			$array['id'],
			$array['name'],
			$array['address'],
			$array['x'],
			$array['y'],
			$array['phone1'],
			$array['phone2'],
			$array['email1'],
			$array['email2'],
			$array['order'],
			$array['logo']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Branch";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getAddress(),
			$object->getX(),
			$object->getY(),
			$object->getPhone1(),
			$object->getPhone2(),
			$object->getEmail1(),
			$object->getEmail2(),
			$object->getOrder(),
			$object->getLogo()	
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getAddress(),
			$object->getX(),
			$object->getY(),
			$object->getPhone1(),
			$object->getPhone2(),
			$object->getEmail1(),
			$object->getEmail2(),
			$object->getOrder(),
			$object->getLogo(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BranchCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>