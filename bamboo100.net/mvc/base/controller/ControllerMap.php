<?php	
	namespace MVC\Controller;
	
	class ControllerMap { 
	
		private $viewMap = array(); 
		private $forwardMap = array(); 
		private $classrootMap = array(); 
		private $classrootTypeMap = array();
 
		function addClassroot( $command, $classroot ) { 
			$this->classrootMap[$command]=$classroot; 
		}
 		function getClassroot( $command ) { 
			if ( isset( $this->classrootMap[$command] ) ) { 
				return $this->classrootMap[$command]; 
			} 
			return $command; 
		} 
		
		function addClassrootType( $command, $type ) { 
			$this->classrootTypeMap[$command]=$type;
		}
		function getClassrootType( $command ){
			if ( isset( $this->classrootTypeMap[$command] ) ) { 
				return $this->classrootTypeMap[$command]; 
			} 
			return $command; 
		}
		
		function addView( $command='default', $status=0, $view ) { 
			$this->viewMap[$command][$status]=$view; 
		} 
 
		function getView( $command, $status ) { 
			if ( isset( $this->viewMap[$command][$status] ) ) { 
				return $this->viewMap[$command][$status]; 
			} 
			return null; 
		} 
 
		function addForward( $command, $status=0, $newCommand ) { 
			$this->forwardMap[$command][$status]=$newCommand; 
		} 
 
		function getForward( $command, $status ) { 
			if ( isset( $this->forwardMap[$command][$status] ) ) { 
				return $this->forwardMap[$command][$status]; 
			} 
			return null; 
		} 
	}
	/*------------------------------------------------------------------------------------*/	
?>
