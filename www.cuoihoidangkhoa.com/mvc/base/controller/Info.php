<?php	
	namespace MVC\Controller;
	
	class Info{
	
		private $App = array();
		
		function addParam( $Name, $Value ){
			$this->App[$Name] = $Value;
		} 
 
		function getParam( $Name ) { 
			if ( isset( $this->App[$Name] ) ) { 
				return $this->App[$Name];
			}
			return null;
		} 
		function getName(){
			return $this->getParam('name');
		}
	}
	/*------------------------------------------------------------------------------------*/	
?>
