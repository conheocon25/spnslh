<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Project extends Mapper implements \MVC\Domain\ProjectFinder {

    function __construct() {
        parent::__construct();
				
		$tblProject = "123appnet_project";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblProject);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProject);
		$updateStmt = sprintf("update %s set name=?, url_doc=?, url_pic=? where id=?", $tblProject);
		$insertStmt = sprintf("insert into %s ( name, url_doc, url_pic) values(?, ?, ?)", $tblProject);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProject);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new ProjectCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Project( 
			$array['id'], 
			$array['name'],
			$array['url_doc'],
			$array['url_pic']
			);
        return $obj;
    }

    protected function targetClass() {        
		return "Project";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getURLDoc(),
			$object->getURLPic()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getURLDoc(),
			$object->getURLPic(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>