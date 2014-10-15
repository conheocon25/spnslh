<?php	
	namespace MVC\Controller;
	
	require_once("mvc/base/command/Command.php");
	require_once("mvc/base/command/DefaultCommand.php");
	/*-----------------------------------------------------------------------------------*/	 	
	class AppController {
		private static $base_cmd; 
		private static $default_cmd; 
		private $controllerMap; 
		private $invoked = array(); 
 
		function __construct( ControllerMap $map ) { 
			$this->controllerMap = $map; 
			if ( ! self::$base_cmd ) { 				
				self::$base_cmd = new \ReflectionClass( "\MVC\Command\Command" ); 
				self::$default_cmd = new \MVC\Command\DefaultCommand();
			} 
		} 
 
		function getView( Request $req ) { 
			$view = $this->getResource( $req, "View" ); 
			return $view; 
		} 
 
		function getForward( Request $req ) { 
			$forward = $this->getResource( $req, "Forward" ); 
			if ( $forward ) { 
				$req->setProperty( 'cmd', $forward ); 
			} 
			return $forward; 
		} 
		private function getResource( Request $req, $res ) {			
			// get the previous command and its execution status 
			$cmd_str = $req->getProperty( 'cmd' ); 
			$previous = $req->getLastCommand(); 
			$status = $previous->getStatus(); 
			if (! $status ) { $status = 0; } 
			
			$acquire = "get$res"; 
			// find resource for previous command and its status 
			$resource = $this->controllerMap->$acquire( $cmd_str, $status ); 
			// alternatively find resource for command and status 0 
			if ( ! $resource ) { 
				$resource = $this->controllerMap->$acquire( $cmd_str, 0 ); 
			} 
			// or command 'default' and command status 
			if ( ! $resource ) { 
				$resource = $this->controllerMap->$acquire( 'default', $status ); 
			} 
			// all else has failed get resource for 'default', status 0 
			if ( ! $resource ) { 
				$resource = $this->controllerMap->$acquire( 'default', 0 ); 
			} 
			return $resource; 
		} 
		
		function getCommand( Request $req ) {
						
			$previous = $req->getLastCommand(); 
			if ( ! $previous ) { 
				// this is the first command this request 
				$cmd = $req->getProperty('cmd'); 
				if ( ! $cmd ) { 						
					// no cmd property - using default 
					$req->setProperty('cmd', 'DefaultCommand' ); 
					return  self::$default_cmd; 
				} 
			} else { 
				// a command has been run already in this request 
				$cmd = $this->getForward( $req ); 
				if ( ! $cmd ) { return null; } 
			}
			
			
			// we now have a command name in $cmd 
			// turn it into a Command object 
			$cmd_obj = $this->resolveCommand( $cmd ); 
			if ( ! $cmd_obj ) { 
				throw new \MVC\Base\AppException( "KHONG TIM THAY LENH '$cmd'" ); 
				//$req->setProperty('cmd', 'ErrNoCommand' ); 
			}
 
			$cmd_class = get_class( $cmd_obj ); 
			
			if ( isset( $this->invoked[$cmd_class] ) ) { 
				throw new \MVC\Base\AppException( "LENH BI LAP VONG" ); 
			}  
			$this->invoked[$cmd_class]=1;
			
			// return the Command object
			return $cmd_obj; 
		}
		function getCommandType( Request $req ){
			$Value = $this->controllerMap->getClassrootType( $req->getProperty('cmd') );
			if (!isset($Value))
				return "private";
			return $Value;
		}
		
 		function resolveCommand( $cmd ) { 
			$classroot = $this->controllerMap->getClassroot( $cmd ); 			
			$filepath = "mvc/command/$classroot.php"; 
			$classname = "{$classroot}"; 
			if ( file_exists( $filepath ) ) { 
				require_once( "$filepath" ); 
				if ( class_exists( "\\MVC\\Command\\".$classname) ) {
					$cmd_class = new \ReflectionClass("\\MVC\\Command\\".$classname); 
					if ( $cmd_class->isSubClassOf( self::$base_cmd ) ) { 
						return $cmd_class->newInstance(); 
					} 
				} 
			} 
			return null;
		} 
	} 	   
	/*------------------------------------------------------------------------------------*/	
?>
