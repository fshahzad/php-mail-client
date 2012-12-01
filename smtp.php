<?php

$server 	= "smtp.gmail.com";
$port		= "587";
$username	= $_SESSION['username'];
$password 	= $_SESSION['password'];
$secure 	= "tls";
$localhost	= "localhost";
$newline	= "\r\n";
$debug 		= false;

// CONNECT

if($secure == 'ssl')
{
	$server = 'ssl://' . $server;
}

$conn = fsockopen($server, $port, $errno, $errstr, '68');
getResponse($conn);

// AUTH

fputs($conn, 'HELO ' . $localhost . $newline);
getResponse($conn);

if($secure == "tls") // mekanisme secure tls
{
	fputs($conn, 'STARTTLS' . $newline);
	getResponse($conn);
	stream_socket_enable_crypto($conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
	fputs($conn, 'HELO ' . $localhost . $newline);
	getResponse($conn);
}

if($server != "localhost") // auth login
{
	fputs($conn, 'AUTH LOGIN' . $newline);
	getResponse($conn);
	fputs($conn, base64_encode($username) . $newline);
	getResponse($conn);
	fputs($conn, base64_encode($password) . $newline);
	getResponse($conn);
}

// SEND EMAIL

$from 			= $_SESSION['username']."@gmail.com";
$to 			= $_POST['to'];
$subject		= $_POST['subject'];
$message		= $_POST['body'];
$content_type	= "text/plain";
$charset		= "\"iso-8859-1\"";

$email  = "Date: " . date("D, j M Y G:i:s") . " -0500" . $newline;
$email .= "From: " . $from . $newline;
$email .= "Reply-To: " . $from . $newline;
$email .= "To: " . $to . $newline;
$email .= "Subject: " . $subject . $newline;
$email .= "MIME-Version: 1.0" . $newline;
$email .= "Content-Type: $content_type; charset=$charset";

$email .= $newline;
$email .= $newline;

$email .= $message;

$email .= $newline;
$email .= "." . $newline;

fputs($conn, 'MAIL FROM: <'. $from .'>'. $newline);
getResponse($conn);
fputs($conn, 'RCPT TO: <'. $to .'>' . $newline);
getResponse($conn);
fputs($conn, 'DATA'. $newline);
getResponse($conn);
fputs($conn, $email);
getResponse($conn);

function getResponse($conn)
{
    $data = "";
    while($str = fgets($conn,4096))
    {
      $data .= $str;
      if(substr($str,3,1) == " ") { break; }
    }
    if($debug) echo $data . "<br>";
    return $data;
}

header("Location: home.php");