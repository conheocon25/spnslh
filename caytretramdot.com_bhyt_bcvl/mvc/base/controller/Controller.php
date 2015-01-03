<?php
	namespace MVC\Controller;
	
	require_once("mvc/base/controller/ApplicationHelper.php");
	require_once("mvc/base/controller/Request.php");		
	class Controller { 
		private $applicationHelper; 
		private function __construct() {} 
 
		static function run() { 
			$instance = new Controller(); 
			$instance->init(); 
			$instance->handleRequest(); 
		}
		
		function init() { 			
			$applicationHelper = ApplicationHelper::instance(); 
			$applicationHelper->init(); 
		} 
 				
		function handleRequest() {			
			$request = new Request();
			$AppController = \MVC\Base\ApplicationRegistry::appController();						
			@$User = \MVC\Base\SessionRegistry::getCurrentUser();			
			
			if (isset($User)&&$User->getEmail()!=""){
				while( $cmd = $AppController->getCommand( $request ) ) {			
					$cmd->execute( $request );					
				}
			}else{
				$Type = $AppController->getCommandType( $request);
				$NameCommand = $request->getProperty('cmd');				
				if ($Type != "public" && isset($NameCommand)){
					$request->setProperty('cmd','Home');
				}else if (!isset($NameCommand)){
					$request->setProperty('cmd','Home');
				}
				
				while( $cmd = $AppController->getCommand( $request ) ) {
					$cmd->execute( $request );
				}
			}						
			$this->invokeView( $AppController->getView( $request ) );
		}
		function invokeView( $target ) {
			require( "mvc/view/$target.php" );
			exit;
		}
	}	
	/*------------------------------------------------------------------------------------*/
	
?>
