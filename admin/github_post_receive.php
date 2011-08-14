<?php
	// Use in the "Post-Receive URLs" section of your GitHub repo.
	if ( $_POST['payload'] ) {
	  `git reset --hard HEAD && git pull`;
	}
?>
