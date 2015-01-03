<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TrackingDomainDaily extends Mapper implements \MVC\Domain\TrackingDomainDailyFinder{

    function __construct() {
        parent::__construct();				
		$tblTrackingDomainDaily = "tbl_tracking_domain_daily";
		
		$selectAllStmt 				= sprintf("select * from %s ORDER BY date", $tblTrackingDomainDaily);
		$selectStmt 				= sprintf("select *  from %s where id=?", $tblTrackingDomainDaily);
		$updateStmt 				= sprintf("update %s set id_domain=?, `date`=?, ticket_selling=?, ticket_selling_back=?, ticket_value=?, paid_ticket=?, paid_debt=? where id=?", $tblTrackingDomainDaily);
		$insertStmt 				= sprintf("insert into %s (id_domain, `date`, ticket_selling, ticket_selling_back, ticket_value, paid_ticket, paid_debt) values(?, ?, ?, ?, ?, ?, ?)", $tblTrackingDomainDaily);
		$deleteStmt 				= sprintf("delete from %s where id=?", $tblTrackingDomainDaily);
		$deleteByDateStmt 			= sprintf("delete from %s where `date`=?", $tblTrackingDomainDaily);
		$findByDateStmt 			= sprintf("select *  from %s where `date`=?", $tblTrackingDomainDaily);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->deleteByDateStmt 	= self::$PDO->prepare($deleteByDateStmt);
		$this->findByDateStmt 		= self::$PDO->prepare($findByDateStmt);
    }
	
    function getCollection( array $raw ) {return new TrackingDomainDailyCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TrackingDomainDaily(
			$array['id'],
			$array['id_domain'],
			$array['date'],
			$array['ticket_selling'],
			$array['ticket_selling_back'],
			$array['ticket_value'],			
			$array['paid_ticket'],
			$array['paid_debt']
		);
	    return $obj;
    }
    protected function targetClass() { return "TrackingDomainDaily";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getDate(),
			$object->getTicketSelling(),
			$object->getTicketSellingBack(),
			$object->getTicketValue(),			
			$object->getPaidTicket(),
			$object->getPaidDebt()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getDate(),
			$object->getTicketSelling(),
			$object->getTicketSellingBack(),
			$object->getTicketValue(),			
			$object->getPaidTicket(),
			$object->getPaidDebt(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteByDate(array $values) {return $this->deleteByDateStmt->execute( $values );}
	
	function findByDate(array $values) {
		$this->findByDateStmt->execute( $values );
        return new TrackingDomainDailyCollection( $this->findByDateStmt->fetchAll(), $this );
    }
	
}
?>