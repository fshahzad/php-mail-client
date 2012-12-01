<?php


$account['username'] = "delisukma";
$account['password'] = "desember89";
$account['mailbox'] = "{imap.gmail.com:993/imap/ssl}INBOX";

function decode_imap_text($str)
{
    $result = '';
    $decode_header = imap_mime_header_decode($str);
    foreach ($decode_header AS $obj) {
        $result .= htmlspecialchars(rtrim($obj->text, "\t"));
	}
    return $result;
}

$imap_handle = @imap_open($account['mailbox'], $account['username'], $account['password']);

if( !$imap_handle )
{
	// error handling
	// imap_last_error()
}
else
{
	// imap_search($imap_handle,'ALL');
	$email = imap_search($imap_handle, 'SINCE '. date('d-M-Y',strtotime("-2 week")));

	if( !$email )
	{
		// handling error while email not found
	}
	else
	{
		include_once("home.php");
	}

	imap_close($stream);
}



?>