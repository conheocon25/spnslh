<?php
Namespace MVC\Library;
class Mail {
	
	private $smtp_host;//Dia chi mail server
	private $admin_email;//User duoc khai bao tren mail server
	private $smtp_username;//User duoc khai bao tren mail server
	private $smtp_password;//Pass cua email nay
	
	function __construct( $smtp_host, $admin_email, $smtp_username, $smtp_password) {        
		define('SMTP_INCLUDED', 1);
		$this->smtp_host = $smtp_host;        
		$this->admin_email = $admin_email; 
		$this->smtp_username = $smtp_username; 
		$this->smtp_password = $smtp_password; 
    }
		
		function server_parse($socket, $response)
		{
		   $server_response = '';
		   while ( substr($server_response,3,1) != ' ' )
		   {
			  if( !( $server_response = fgets($socket, 256) ) )
			  {
				 echo "Couldn't get mail server response codes";
			  }
		   }

		   if( !( substr($server_response, 0, 3) == $response ) )
		   {
			  echo "Ran into problems sending Mail. Response: $server_response";
		   }
		}

		function smtpmail($mail_to, $subject, $message, $headers='')
		{
				$message = preg_replace("/(?<!\r)\n/si", "\r\n", $message);
		  		if ($headers != "")
				{
						if(is_array($headers))
						{
								if(sizeof($headers) > 1)
								{
										$headers = join("\r\n", $headers);
								}
								else
								{
										$headers = $headers[0];
								}
						}
						$headers = chop($headers);

						
						$headers = preg_replace("/(?<!\r)\n/si", "\r\n", $headers);
						
						$header_array = explode("\r\n", $headers);
						@reset($header_array);
						$headers = "";
						$cc = '';
						$bcc = '';
						while( list(, $header) = each($header_array) )
						{
								if( preg_match("/^cc:/si", $header) )
								{
										$cc = preg_replace("/^cc:(.*)/si", "\\1", $header);
								}
								else if( preg_match("/^bcc:/si", $header ))
								{
										$bcc = preg_replace("/^bcc:(.*)/si", "\\1", $header);
										$header = "";
								}
								$headers .= $header . "\r\n";
						}
						$headers = chop($headers);
						$cc = explode(",", $cc);
						$bcc = explode(",", $bcc);
				}


				if(trim($mail_to) == "")
				{
						exit();
				}
				if(trim($subject) == "")
				{
						die("No email Subject specified");
				}

				$mail_to_array = explode(",", $mail_to);

				if( !$socket = fsockopen($this->smtp_host, 25, $errno, $errstr, 20) )
				{
						die("Could not connect to smtp host : $errno : $errstr");
				}
				$this->server_parse($socket, "220");

				if( !empty($this->smtp_username) && !empty($this->smtp_password) )
				{						
						fputs($socket, "EHLO " . $this->smtp_host . "\r\n");
						$this->server_parse($socket, "250");

						fputs($socket, "AUTH LOGIN\r\n");
						$this->server_parse($socket, "334");
						fputs($socket, base64_encode($this->smtp_username) . "\r\n");
						$this->server_parse($socket, "334");
						fputs($socket, base64_encode($this->smtp_password) . "\r\n");
						$this->server_parse($socket, "235");
				}
				else
				{
						fputs($socket, "HELO " . $this->smtp_host . "\r\n");
						$this->server_parse($socket, "250");
				}
							
				fputs($socket, "MAIL FROM: <" . $this->admin_email . ">\r\n");
				$this->server_parse($socket, "250");

				$to_header = "To: ";
				@reset( $mail_to_array );
				while( list( , $mail_to_address ) = each( $mail_to_array ))
				{						
						$mail_to_address = trim($mail_to_address);
						if ( preg_match('/[^ ]+\@[^ ]+/', $mail_to_address) )
						{
								fputs( $socket, "RCPT TO: <$mail_to_address>\r\n" );
								$this->server_parse( $socket, "250" );
						}
						$to_header .= "<$mail_to_address>, ";
				}
			
				@reset( $bcc );
				while( list( , $bcc_address ) = each( $bcc ))
				{					
						$bcc_address = trim( $bcc_address );
						if ( preg_match('/[^ ]+\@[^ ]+/', $bcc_address) )
						{
								fputs( $socket, "RCPT TO: <$bcc_address>\r\n" );
								$this->server_parse( $socket, "250" );
						}
				}
				@reset( $cc );
				while( list( , $cc_address ) = each( $cc ))
				{						
						$cc_address = trim( $cc_address );
						if ( preg_match('/[^ ]+\@[^ ]+/', $cc_address) )
						{
								fputs($socket, "RCPT TO: <$cc_address>\r\n");
								$this->server_parse($socket, "250");
						}
				}
			
				fputs($socket, "DATA\r\n");			
				$this->server_parse($socket, "354");

				fputs($socket, "Subject: $subject\r\n");			
				fputs($socket, "$to_header\r\n");				
				fputs($socket, "$headers\r\n\r\n");				
				fputs($socket, "$message\r\n");				
				fputs($socket, ".\r\n");
				$this->server_parse($socket, "250");
				fputs($socket, "QUIT\r\n");
				fclose($socket);

				return TRUE;
		}
		public function SendMail($fromfullname, $frommail,$tomail,$subject,$message)
		{			 
			  $from= $fromfullname." <".$frommail.">";
			  $headers ="Return-Path: ".$fromfullname." <".$frommail.">\r\n";
			  $headers.="From: $from\nX-Mailer: ".$fromfullname."\r\n";
			  $headers .="Mime-Version: 1.0\r\n";
			  $headers .="Content-type: text/html; charset=utf-8\r\n";			 
			  $result = @$this->smtpmail($tomail,$subject,$message,$headers);
		}
}
?>