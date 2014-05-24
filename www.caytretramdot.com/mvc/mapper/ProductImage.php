<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class ProductImage extends Mapper implements \MVC\Domain\ProductImageFinder {

    function __construct() {
        parent::__construct();
		$tblProductImage = "shopc_product_image";
						
		$selectAllStmt = sprintf("select * from %s", $tblProductImage);
		$selectStmt = sprintf("select * from %s where id=?", $tblProductImage);
		$updateStmt = sprintf("update %s set 
				idproduct=?,
				name=?, 
				`date`=?, 				
				url=? 
			where id=?", $tblProductImage);
			
		$insertStmt = sprintf("insert into %s ( 
					idproduct, 					
					name, 
					`date`, 					
					url
				) 
				values( ?, ?, ?, ?)", $tblProductImage);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProductImage);
		$findByStmt = sprintf("select * from %s where idproduct=?", $tblProductImage);
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE idsupplier=:idsupplier
							LIMIT :start,:max
				", $tblProductImage);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new ProductImageCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\ProductImage( 
			$array['id'],
			$array['idproduct'],			
			$array['name'],						
			$array['date'],	
			$array['url']
		);
        return $obj;
    }
	
    protected function targetClass(){return "ProductImage";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdProduct(),
			$object->getName(),	
			$object->getDate(),
			$object->getURL()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdProduct(),
			$object->getName(),
			$object->getDate(),
			$object->getURL(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}			
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new ProductImageCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new ProductImageCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>