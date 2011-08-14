<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
if($_POST['payload']) {
	`git reset --hard HEAD && git pull`;
	
	$to = "andy@workportfolio.co.uk";
	$subject = "[JBI Updated] - " + date("r");
	$body = "Github pushed changes to JBI automatically.";
	mail($to, $subject, $body);
	
}?>
