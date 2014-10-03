<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Image extends Mapper implements \MVC\Domain\ImageFinder {

    function __construct() {
        parent::__construct();
		$tblImage = "res_product_image";
						
		$selectAllStmt = sprintf("select * from %s", $tblImage);
		$selectStmt = sprintf("select * from %s where id=?", $tblImage);
		$updateStmt = sprintf("update %s set 
				idresource=?,
				name=?, 
				`date`=?, 				
				url=? 
			where id=?", $tblImage);
			
		$insertStmt = sprintf("insert into %s ( 
					idresource, 					
					name, 
					`date`, 					
					url
				) 
				values( ?, ?, ?, ?)", $tblImage);
		$deleteStmt = sprintf("delete from %s where id=?", $tblImage);
		$findByStmt = sprintf("select * from %s where idresource=?", $tblImage);
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE idsupplier=:idsupplier
							LIMIT :start,:max
				", $tblImage);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new ImageCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Image( 
			$array['id'],
			$array['idresource'],			
			$array['name'],						
			$array['date'],	
			$array['url']
		);
        return $obj;
    }
	
    protected function targetClass(){return "Image";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdResource(),
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
			$object->getIdResource(),
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
        return new SupplierCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new ImageCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>