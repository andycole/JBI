<?php
ini_set('error_reporting', E_ALL);
// Use in the "Post-Receive URLs" section of your GitHub repo.
if( isset($_POST['payload']) ) {
	shell_exec('cd /kunden/homepages/30/d170410374/htdocs/JBI && git reset --hard HEAD && git pull');
	
	$to = "andy@workportfolio.co.uk";
	$subject = "[JBI Updated] - " . date("r");
	$body = "Github pushed changes to JBI automatically.";
	mail($to, $subject, $body);
	
} else {
	echo 'failed';
}
?>
