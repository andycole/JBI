<?php
ini_set('error_reporting', E_ALL);

// Use in the "Post-Receive URLs" section of your GitHub repo.

if (!empty($_POST) && !empty($_POST['payload'])) {
	//$payload = json_decode($_POST['payload']);
	print(shell_exec('git pull origin master'));
	
	$to = "andy@workportfolio.co.uk";
	$subject = "[JBI Updated] - " . date("r");
	$body = "Github pushed changes to JBI automatically.";
	mail($to, $subject, $body);
}

?>
<form action="github_post_receive.php" name="test" method="post">
	<input type="hidden" name="payload" id="payload" value="true" />
	<input type="submit" name="submit" />
</form>