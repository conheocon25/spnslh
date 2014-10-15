<?php	
	namespace MVC\Controller;
	
	require_once("mvc/base/Registry.php");
	
	class Request{
		private $appreg;
		private $properties;
		private $objects = array();
		private $feedback = array();
		private $lastCommand;
		/*--------------------------------------------------------------------------------*/
		function __construct() { 
			$this->init(); 
			\MVC\Base\RequestRegistry::setRequest($this); 
		} 
		/*--------------------------------------------------------------------------------*/
		function init() { 
			if ( isset( $_SERVER['REQUEST_METHOD'] ) ) { 
				$this->properties = $_REQUEST; 
				return; 
			} 
 
			foreach( $_SERVER['argv'] as $arg ) { 
				if ( strpos( $arg, '=' ) ) { 
					list( $key, $val )=explode( "=", $arg ); 
					$this->setProperty( $key, $val ); 
				} 
			} 
		} 	
		/*--------------------------------------------------------------------------------*/
		function setProperty( $key, $val ) { 
			$this->properties[$key] = $val; 
		}
		function getProperty( $key ) { 
			if ( isset( $this->properties[$key] ) ) { 
				return $this->properties[$key]; 
			} 
		}		
		function getProperties( ){
			return $this->properties;
		}
		
		/*--------------------------------------------------------------------------------*/
		function __clone() {
			$this->properties = array();
		}	
		/*--------------------------------------------------------------------------------*/
		function addFeedback( $msg ) { 
			array_push( $this->feedback, $msg ); 
		}
		/*--------------------------------------------------------------------------------*/
		function getFeedback( ) { 
			return $this->feedback; 
		}
		/*--------------------------------------------------------------------------------*/
		function getFeedbackString( $separator="\n" ) { 
			return implode( $separator, $this->feedback ); 
		} 
		/*--------------------------------------------------------------------------------*/
		function setObject( $name, $object ) {
			$this->objects[$name] = $object;
		}		
		function getObject( $name ) {
			if ( isset( $this->objects[$name] ) ) {
				return $this->objects[$name];
			}
			return null;
		}
		function getObjects(){
			return $this->objects;
		}
		/*--------------------------------------------------------------------------------*/
		function setCommand( \MVC\Command\Command $command ) {
			$this->lastCommand = $command;
		}
		/*--------------------------------------------------------------------------------*/
		function getLastCommand(){
			return $this->lastCommand;
		}		
	}
?>
