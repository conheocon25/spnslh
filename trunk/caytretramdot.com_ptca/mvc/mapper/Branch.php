<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Branch extends Mapper implements \MVC\Domain\BranchFinder {

    function __construct() {
        parent::__construct();
		$tblBranch 				= "branch";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from branch");
        $this->updateStmt 		= self::$PDO->prepare("update branch set id_group=?, name=?, tel=?, fax=?, address=?, `key`=?, `enable`=?  where id=?");
        $this->selectStmt 		= self::$PDO->prepare("select * from branch where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into branch (id_group, name, tel, fax, address, `key`, enable) values(?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from branch where id=?");
		$this->findByKeyStmt 	= self::$PDO->prepare("select *  from branch where `key`=?");
		$this->findByGroupStmt 	= self::$PDO->prepare("SELECT * FROM branch WHERE id_group=? ORDER BY name");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblBranch);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
		$findByGroupPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_group=:id_group LIMIT :start,:max", $tblBranch);
		$this->findByGroupPageStmt 	= self::$PDO->prepare($findByGroupPageStmt);		 
    } 
    function getCollection( array $raw ) {return new BranchCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Branch( 
			$array['id'], 
			$array['id_group'],
			$array['name'],
			$array['tel'],
			$array['fax'],
			$array['address'],
			$array['key'],
			$array['enable']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Branch";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getTel(),
			$object->getFax(),
			$object->getAddress(),
			$object->getKey(),
			$object->getEnable()
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
			$object->getAddress(),
			$object->getKey(),
			$object->getEnable(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByKey( $values ){
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BranchCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByGroup($values) {		
        $this->findByGroupStmt->execute( $values );
        return new BranchCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByGroupPage( $values ) {
		$this->findByGroupPageStmt->bindValue(':id_group', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->execute();
        return new BranchCollection( $this->findByGroupPageStmt->fetchAll(), $this );
    }
}
?>