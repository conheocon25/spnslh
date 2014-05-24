<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class OrderExport extends Mapper implements \MVC\Domain\OrderImportFinder{

    function __construct() {
        parent::__construct();
		
		$tblOrderExport 		= "shopc_order_export";
		$tblOrderExportDetail 	= "shopc_order_export_detail";
								
		$selectAllStmt = sprintf("select * from %s", $tblOrderExport);
		$selectStmt = sprintf("select * from %s where id=?", $tblOrderExport);
		$updateStmt = sprintf("update %s set idcustomer=?, date=?, note=? where id=?", $tblOrderExport);
		$insertStmt = sprintf("insert into %s ( idcustomer, date, note ) values( ?, ?, ?)", $tblOrderExport);
		$deleteStmt = sprintf("delete from %s where id=?", $tblOrderExport);
		
		$findCurrentStmt = sprintf("
			select 
				*
			from 
				%s 			
			order by id DESC, `date` DESC
			limit 1
		", $tblOrderExport);
		
		$findTop5Stmt = sprintf("
			select 
				*
			from 
				%s 			
			order by date DESC
			limit 5
		", $tblOrderExport);
		
		$findByStmt = sprintf("
			select 
				*
			from 
				%s 
			where idcustomer=?
			order by date DESC
		", $tblOrderExport);
				
		$findByTrackingStmt = sprintf("
			select
				*
			from 
				%s
			where
				date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblOrderExport);
		
		$findByTracking1Stmt = sprintf("
			select
				*
			from 
				%s
			where
				idcustomer=? AND date >= ? AND date <= ?
			order by 
				date DESC
			"
		, $tblOrderExport);
		
		$findByPageStmt = sprintf("
							SELECT * 
							FROM %s 							 
							WHERE idcustomer=:idcustomer
							ORDER BY date desc
							LIMIT :start,:max
				", $tblOrderExport);
										
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );
		$this->findByStmt = self::$PDO->prepare( $findByStmt );		
		$this->findByTrackingStmt 	= self::$PDO->prepare( $findByTrackingStmt );
		$this->findByTracking1Stmt 	= self::$PDO->prepare( $findByTracking1Stmt );
		$this->findByPageStmt 		= self::$PDO->prepare( $findByPageStmt );
		$this->findCurrentStmt 		= self::$PDO->prepare( $findCurrentStmt );
		$this->findTop5Stmt 		= self::$PDO->prepare( $findTop5Stmt );
    }
	
    function getCollection( array $raw ) {return new OrderImportCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\OrderExport( 
			$array['id'],  
			$array['idcustomer'], 
			$array['date'],	
			$array['note']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "OrderExport";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdCustomer(), 
			$object->getDate(),
			$object->getNote()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCustomer(),
			$object->getDate(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
	//-------------------------------------------------------
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new OrderImportCollection( $this->findByStmt->fetchAll(), $this );
    }
		
	function findByTracking(array $values){
        $this->findByTrackingStmt->execute( $values );
        return new OrderImportCollection( $this->findByTrackingStmt->fetchAll(), $this );
    }
	
	function findByTracking1(array $values){
        $this->findByTracking1Stmt->execute( $values );
        return new OrderExportCollection( $this->findByTracking1Stmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':idcustomer', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new OrderExportCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findCurrent( ) {	
		$this->findCurrentStmt->execute( array() );
        $array = $this->findCurrentStmt->fetch();
        $this->findCurrentStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findTop5(array $values){
        $this->findTop5Stmt->execute( $values );
        return new OrderExportCollection( $this->findTop5Stmt->fetchAll(), $this );
    }
	
	//-------------------------------------------------------
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
}
?>