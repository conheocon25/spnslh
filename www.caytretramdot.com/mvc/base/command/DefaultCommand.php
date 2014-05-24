<?php
	namespace MVC\Command;
	require_once("mvc/base/command/Command.php"); 
	class DefaultCommand extends Command {
		function doExecute( \MVC\Controller\Request $request ) { 
					
			return self::statuses('CMD_OK');
		} 
	} 
?>
