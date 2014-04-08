<?php
	namespace MVC\Command;
	abstract class Command { 
		private static $STATUS_STRINGS = array ( 
			'CMD_DEFAULT'=>0, 
			'CMD_OK' => 1, 
			'CMD_ERROR' => 2, 
			'CMD_INSUFFICIENT_DATA' => 3, 
			'CMD_NO_AUTHOR' => 4 
		); 
		private $status = 0;
   
		final function __construct() { } 
 
		function execute( \MVC\Controller\Request  $request ) { 
			$this->status = $this->doExecute( $request ); 
			$request->setCommand( $this ); 
		} 
		function getStatus() { 
			return $this->status; 
		} 
		static function statuses( $str='CMD_DEFAULT' ) { 
			if ( empty( $str ) ) { $str = 'CMD_DEFAULT'; } 
			// convert string into a status number 
			return self::$STATUS_STRINGS[$str]; 
		} 
		abstract function doExecute( \MVC\Controller\Request $request );
	} 
?>
