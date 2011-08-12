<?PHP 
//header('Content-Type: text/html; charset=utf-8');
include ('inc/functions.php');
connectdata ();

// Page title override: Uncomment and change text to alter page title.
// $config['page_title']='New page title';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?PHP echo $config['page_title'];?></title>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="INDEX,FOLLOW"  >
<meta name="revisit-after" content="1 days" >
<link rel="stylesheet" href="<?PHP echo $config['thissite'];?>/inc/global.css" type="text/css" />
<link rel="shortcut icon" href="<?PHP echo $config['thissite'];?>/favicon.ico">
<script tupe="text/javascript" SRC="<?PHP echo $config['thissite'];?>/inc/clip.php"></script>
</head>

<body>
<CENTER>
<!-- wrap starts here -->
<DIV class="wrapper">

<?PHP include_once('inc/header.php') ?>
			
	<!-- content starts -->
	<div class="content">
	
		<div class="main">

<?PHP search_results ($searchterm); ?>

		<!-- main ends -->	

		</div>
				
		<div class="sidebar">
			<DIV CLASS="voucher alphalist">
			<?php
			alphalist();
			?></DIV>			
			<form id="qsearch" action="search.php" method="get" >
			<p>
			<label for="qsearch">Search:</label>
			<input class="tbox" type="text" name="qsearch" value="" title="Start typing and hit ENTER" />
			<input class="btn" alt="Search" type="image" name="searchsubmit" title="Search" src="<?PHP echo $config['thissite']; ?>/images/search.gif" />
			</p>
			</form>	
											
<?PHP draw_latest_vouchers('6');?>

		<!-- sidebar ends -->		
		</div>	
		
	<!-- content ends-->	
	</div>

<P>Copyright 2008</P>

<!-- wrap ends here -->

</DIV>
<BR/>
</CENTER>
</body>
</html>