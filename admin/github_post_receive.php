<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  shell_exec( 'cd /kunden/homepages/30/d170410374/htdocs/JBI/ && git reset --hard HEAD && git pull' );
}

?>hey dawg, sup?