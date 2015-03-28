<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SaleCommandDetail extends Mapper implements \MVC\Domain\UserFinder {

    function __construct() {
        parent::__construct();
					
		$tblSaleCommand 		= "sale_command";
		$tblSaleCommandDetail 	= "sale_command_detail";
				
		$selectAllStmt = sprintf("select * from %s", $tblSaleCommandDetail);
		$selectStmt = sprintf("select * from %s where id=?", $tblSaleCommandDetail);
		$updateStmt = sprintf("update %s set id_command=?, id_good=?, count1=?, count2=?, count3=? where id=?", $tblSaleCommandDetail);
		$insertStmt = sprintf("insert into %s (id_command, id_good, count1, count2, count3) values(?, ?, ?, ?, ?)", $tblSaleCommandDetail);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSaleCommandDetail);
				
		$findByStmt = sprintf("select * from %s where id_command=?", $tblSaleCommandDetail);
						
		$checkStmt = sprintf("
			select 
				distinct id 
			from 
				%s 
			where 
				id_command=? and 
				id_good=?
		", $tblSaleCommandDetail);
				
		/*
        * Gán chuỗi vừa được xử lí cho các Statement của PDO
		* luôn đảm bảo các tiền tố được truyền đi đúng
        */
        $this->selectAllStmt = self::$PDO->prepare( $selectAllStmt);
        $this->selectStmt = self::$PDO->prepare( $selectStmt );
        $this->updateStmt = self::$PDO->prepare( $updateStmt );
        $this->insertStmt = self::$PDO->prepare( $insertStmt );
		$this->deleteStmt = self::$PDO->prepare( $deleteStmt );
                            
		$this->findByStmt 	= self::$PDO->prepare($findByStmt);						
		$this->checkStmt 			= self::$PDO->prepare( $checkStmt);		
		
    } 
    function getCollection( array $raw ) {return new SaleCommandDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SaleCommandDetail( 
			$array['id'],
			$array['id_command'],
			$array['id_good'], 
			$array['count1'],
			$array['count2'],
			$array['count3']			
		);
        return $obj;
    }
    protected function targetClass() {return "SaleCommandDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdInvoice(),
			$object->getIdGood(),
			$object->getCount1(),
			$object->getCount2(),			
			$object->getCount3()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdInvoice(),
			$object->getIdGood(),
			$object->getCount1(),
			$object->getCount2(),
			$object->getCount3(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ) {	
        $this->findByStmt->execute( $values );
        return new SaleCommandDetailCollection( $this->findByStmt->fetchAll(), $this );
    }
		
	function check( $values ) {	
        $this->checkStmt->execute( $values );
		$result = $this->checkStmt->fetchAll();		
		if (!isset($result) || $result==null)
			return null;        
        return $result[0][0];
    }	
}
?>