<?php	
	namespace MVC\Controller;
	
	require_once("mvc/base/Registry.php");	
	require_once("mvc/base/Exceptions.php");
	require_once("mvc/base/controller/Info.php");
	require_once("mvc/base/controller/ControllerMap.php");
	
	/*-----------------------------------------------------------------------------------*/				
	class ApplicationHelper { 
		private static $instance; 
		
		private $info = "data/info.xml"; 
		private $config = "data/settings.xml"; 
		 
		private function __construct() {} 
 
		static function instance() { 
			if ( ! self::$instance ) { 
				self::$instance = new self(); 
			} 
			return self::$instance; 
		} 
  
		function init() { 
			$dsn = \MVC\Base\ApplicationRegistry::getDSN( );
			if ( ! is_null( $dsn ) ) { 
				return; 
			} 
			$this->getOptions();
			$this->getInfo();
		}
		
		private function getInfo(){
			$this->ensure( file_exists( "data/info.xml"  ), "Khong tim thay tap tin INFO");			
			$info = @SimpleXml_load_file( "data/info.xml" );
			
			//Lấy về bản đồ điều khiển Controller
			$map = new Info();

			foreach ( $info->param as $line ){
				$name = trim((string)$line->name);
				$value = trim((string)$line->value);			
				$map->addParam( $name, $value);
			}
			
			\MVC\Base\ApplicationRegistry::setInfo( $map );
		}
		
		private function getOptions() { 
			$this->ensure( file_exists( $this->config  ), 
                            "Could not find options file" );
			
			$options = @SimpleXml_load_file( $this->config );						
			//$this->ensure( $options instanceof SimpleXMLElement,
            //                "Could not resolve options file" );
						
			
			//Lấy về bản đồ điều khiển Controller
			$map = new ControllerMap();

			foreach ( $options->control->view as $default_view ) {
				$stat_str = trim($default_view['status']); 
				$status = \MVC\Command\Command::statuses( $stat_str );
				$map->addView( 'default', $status, (string)$default_view );
			}
			foreach ( $options->control->command as $command_view ) {
				$command =  trim((string)$command_view['name'] );
				$type =  trim((string)$command_view['type'] );
				//echo "--".$command.":".$type;
				$map->addClassrootType( $command, $type );
				
				if ( $command_view->classalias ) {
					$classroot = trim((string)$command_view->classalias['name']);
					$map->addClassroot( $command, $classroot);
				}
				if ( $command_view->view ) {
					$view =  trim((string)$command_view->view);
					$forward = trim((string)$command_view->forward);
					$map->addView( $command, 0, $view );
					
					if ( $forward ) {
						$map->addForward( $command, 0, $forward );
					}
					foreach( $command_view->status as $command_view_status ) {
						$view =  trim((string)$command_view_status->view);
						$forward = trim((string)$command_view_status->forward);
						$stat_str = trim($command_view_status['value']); 
						$status = \MVC\Command\Command::statuses( $stat_str );
						if ( $view ) {
							$map->addView( $command, $status, $view );
						}
						if ( $forward ) {
							$map->addForward( $command, $status, $forward );
						}
					}
				}
			}			
			\MVC\Base\ApplicationRegistry::setControllerMap( $map );
		} 
 
		private function ensure( $expr, $message ) { 
			if ( ! $expr ) { 
				throw new \MVC\Base\AppException( $message );
			} 
		}
	} 		
	/*------------------------------------------------------------------------------------*/
	
?>
