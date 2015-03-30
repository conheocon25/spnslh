<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SaleCommand extends Mapper implements \MVC\Domain\SaleCommandFinder {

    function __construct() {
        parent::__construct();
		$tblSaleCommand 		= "sale_command";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from sale_command");
        $this->selectStmt 		= self::$PDO->prepare("select * from sale_command where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update sale_command set id_user=?, id_branch=?, datetime=?, note=?, state=? where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into sale_command (id_user, id_branch, datetime, note, state) values(?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from sale_command where id=?");
		
		$this->findByStateStmt	= self::$PDO->prepare("select * from sale_command where state=? ORDER BY datetime DESC");		
		$this->findByUserStmt	= self::$PDO->prepare("select * from sale_command where id_user=? ORDER BY datetime DESC");
		$this->findByBranchStmt	= self::$PDO->prepare("select * from sale_command where id_branch=? ORDER BY datetime DESC");
		
		$this->findByBranchDateStateStmt 	= self::$PDO->prepare("select * from sale_command where id_branch=? AND date(datetime)=? AND state=? ORDER BY datetime DESC");
		$this->findByBranchQueueStmt 		= self::$PDO->prepare("select * from sale_command where id_branch=? AND state<2 ORDER BY datetime DESC");
		$this->findByBranchFinishStmt 		= self::$PDO->prepare("select * from sale_command where id_branch=? AND state>=2 ORDER BY datetime DESC");
		$this->findByDateStateStmt 			= self::$PDO->prepare("select * from sale_command where date(datetime)=? AND state=? ORDER BY datetime DESC");
						
		$findByPageStmt 			= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSaleCommand);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new SaleCommandCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SaleCommand( 
			$array['id'],
			$array['id_user'],			
			$array['id_branch'],
			$array['datetime'],
			$array['note'],
			$array['state']
		);
        return $obj;
    }
	
    protected function targetClass() {return "SaleCommand";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdUser(),			
			$object->getIdBranch(),
			$object->getDateTime(),			
			$object->getNote(),
			$object->getState()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdUser(),			
			$object->getIdBranch(),
			$object->getDateTime(),			
			$object->getNote(),
			$object->getState(),
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
        return new SaleCommandCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByState($values){
        $this->findByStateStmt->execute( $values );
        return new SaleCommandCollection( $this->findByStateStmt->fetchAll(), $this );
    }
	
	function findByBranch($values) {
        $this->findByBranchStmt->execute( $values );
        return new SaleCommandCollection( $this->findByBranchStmt->fetchAll(), $this );
    }
	
	function findByDateState($values) {
        $this->findByDateStateStmt->execute( $values );
        return new SaleCommandCollection( $this->findByDateStateStmt->fetchAll(), $this );
    }
	
	function findByBranchDateState($values) {
        $this->findByBranchDateStateStmt->execute( $values );
        return new SaleCommandCollection( $this->findByBranchDateStateStmt->fetchAll(), $this );
    }
	
	function findByBranchQueue($values){
        $this->findByBranchQueueStmt->execute( $values );
        return new SaleCommandCollection( $this->findByBranchQueueStmt->fetchAll(), $this );
    }
	
	function findByBranchFinish($values){
        $this->findByBranchFinishStmt->execute( $values );
        return new SaleCommandCollection( $this->findByBranchFinishStmt->fetchAll(), $this );
    }
	
	function findByUser($values){
        $this->findByUserStmt->execute( $values );
        return new SaleCommandCollection( $this->findByUserStmt->fetchAll(), $this );
    }
	
}
?>