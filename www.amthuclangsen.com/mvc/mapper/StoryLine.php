<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class StoryLine extends Mapper implements \MVC\Domain\StoryLineFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare( 
                            "select * from shopc_storyline");
        $this->selectStmt = self::$PDO->prepare("select * from shopc_storyline where id=?");
        $this->updateStmt = self::$PDO->prepare("update shopc_storyline set `date`=?, name=?, image=?, title=?, note=? where id=?");
        $this->insertStmt = self::$PDO->prepare("insert into shopc_storyline (`date`, name, image, title, note) 
							values( ?, ?, ?, ?, ?)");
		$this->deleteStmt = self::$PDO->prepare("delete from shopc_storyline where id=?");		
						
		$tblStoryLine = "shopc_storyline";
		$findByPageStmt = sprintf("SELECT * FROM %s ORDER BY name LIMIT :start,:max", $tblStoryLine);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new StoryLineCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\StoryLine( 
			$array['id'],  
			$array['date'],
			$array['name'],
			$array['image'],
			$array['title'],
			$array['note']			
		);
        return $obj;
    }	
    protected function targetClass() { return "StoryLine";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getDate(),
			$object->getName(),
			$object->getImage(),
			$object->getTitle(),
			$object->getNote()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getDate(),
			$object->getName(),
			$object->getImage(),
			$object->getTitle(),
			$object->getNote(),
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
        return new StoryLineCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>