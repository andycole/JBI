<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  shell_exec( 'cd /kunden/homepages/30/d170410374/htdocs/JBI/ && git reset --hard HEAD && git pull' );
}

if ( $_POST['test'] ) {
  shell_exec( 'cd /kunden/homepages/30/d170410374/htdocs/JBI/ && git reset --hard HEAD && git pull' );
}


?>
<form action="/admin/github_post_receive.php">
	<input type="text" name="test" id="test"  />
	<input type="submit" />	
</form>
