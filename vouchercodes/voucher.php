<?PHP 
header('Content-Type: text/html; charset=utf-8');
include ('inc/functions.php');
connectdata ();

// Page title override.

 $config['page_title']=cleandata($merchtarget).' '.$config['page_title'];?>

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

<DIV class="wrapper">

<?PHP IF($_GET['rewr']) include_once('inc/header.php'); ELSE include_once('inc/header.php');  ?>

			
	<!-- content starts -->
	<div class="content">
	
		<div class="main">

			<h2><?PHP echo cleandata($merchtarget);?> Voucher Codes</h2>
<?PHP draw_description_merchant($merchtarget);?>

<?PHP draw_vouchers_merchant($merchtarget);?> 

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

<P>Copyright 2008. <?PHP IF ($config['showthumbs']) echo '<a href="http://www.thumbshots.net" target="_blank" rel="nofollow" title="Thumbnails by Thumbshots.net">Thumbnails by Thumbshots.net</a>';?></P>


</DIV>
<BR/>
</CENTER>
</body>
</html>