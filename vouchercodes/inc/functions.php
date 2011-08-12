<?php

require_once('config.php');

// Clean Data

function cleandata ($cleantarget)
{
$cleantarget = TRIM($cleantarget);
$cleantarget = STRIPSLASHES($cleantarget);
$cleantarget = nl2br($cleantarget);
$cleantarget = str_replace("iframe", "R3PL4C31FR4M3", $cleantarget);
$cleantarget=strip_tags($cleantarget,'<p><a><br><img><b><strong><small><script><big><hr><i><iframe><blockquote><ul><li>');

$cleantarget = str_replace("£", "&pound;", $cleantarget);
$cleantarget = str_replace("%", "&#37;", $cleantarget);
$cleantarget = str_replace("$", "&#36;", $cleantarget);
$cleantarget = str_replace("¤", "&pound;", $cleantarget);

$cleantarget = str_replace("-", "R3PL4C3HYPH3N", $cleantarget);

$cleantarget = ereg_replace("[^{A-Z}{a-z}{0-9}{ }{_}{.}{,}{ }{-}{\-}{%}{;}{&}{<}{>}{+}{%}{?}{/}{#}{:}{!}{=}{\"}]", "", $cleantarget);
$cleantarget = str_replace("R3PL4C3HYPH3N", "-", $cleantarget);
$cleantarget = str_replace("R3PL4C31FR4M3", "iframe", $cleantarget);

$cleanedup=$cleantarget;
return $cleanedup;
} 


function makeurlsafe ($cleantarget)
{
$cleantarget = str_replace("+", "_", $cleantarget);
$cleantarget = str_replace(" ", "_", $cleantarget);
$cleantarget = str_replace("%20", "_", $cleantarget);

$cleantarget = str_replace(".co.uk", "", $cleantarget);
$cleantarget = str_replace(".com", "", $cleantarget);
$cleantarget = str_replace(".net", "", $cleantarget);

$cleantarget = str_replace("-", "R3PL4C3HYPH3N", $cleantarget);
$cleantarget = ereg_replace("[^{A-Z}{a-z}{0-9}{ }{_}{.}{,}{ }{-}{\-}{%}{;}{&}{<}{>}{+}{%}{?}{/}{#}{:}{!}{=}{\"}]", "", $cleantarget);
$cleantarget = str_replace("R3PL4C3HYPH3N", "-", $cleantarget);

$cleanedup=$cleantarget;
$cleantarget=urlencode($cleantarget);
return $cleanedup;
}


function publicurlsafe ($cleantarget)
{
$cleantarget = str_replace(".co.uk", "", $cleantarget);
$cleantarget = str_replace(".com", "", $cleantarget);
$cleantarget = str_replace(".net", "", $cleantarget);

$cleantarget = str_replace("-", "R3PL4C3HYPH3N", $cleantarget);
$cleantarget = ereg_replace("[^{A-Z}{a-z}{0-9}{ }{_}{-}{\-}{;}{&}{?}{#}{:}{;}]", "", $cleantarget);
$cleantarget = str_replace("R3PL4C3HYPH3N", "-", $cleantarget);

$cleanedup=$cleantarget;
$cleantarget=urlencode($cleantarget);
return $cleanedup;
} 


function makeurlusable ($cleantarget)
{
$cleantarget=urlencode($cleantarget);
$cleantarget = str_replace("+", " ", $cleantarget);
$cleantarget = str_replace("_", " ", $cleantarget);

$cleantarget = str_replace("-", "R3PL4C3HYPH3N", $cleantarget);
$cleantarget = ereg_replace("[^{A-Z}{a-z}{0-9}{ }{_}{.}{,}{ }{-}{\-}{%}{;}{&}{<}{>}{+}{%}{#}{?}{:}]", "", $cleantarget);
$cleantarget = str_replace("R3PL4C3HYPH3N", "-", $cleantarget);
$cleanedup=$cleantarget;
return $cleanedup;
} 


// PARSE incoming GET variables so you don't have to bother doing it on every page
IF ($_REQUEST['quer']) $merchtarget = makeurlusable($_REQUEST['quer']);
IF ($_REQUEST['let']) $lettertarget = cleandata($_REQUEST['let']);


IF ($_GET['qsearch'])
{
$searchterm=cleandata($_GET['qsearch']);
$searchterm=cleandata($searchterm);
}


// Connect to DB
function connectdata ()
{
global $dbh,$dbhost,$dbpass,$dbuser,$dbselect;
    $dbh=mysql_connect("$dbhost","$dbuser","$dbpass");
    mysql_select_db("$dbselect");
}


// Close DB
function closedata ()
{
global $dbh;
mysql_close($dbh);
}


// Draw the alphabetic list
function alphalist ()
{
global $config;
echo '<A HREF="'.$config['thissite'].'/alpha.php?let=9">0-9</A>';
foreach(range('A', 'Z') as $letter) { echo ' <A HREF="'.$config['thissite'].'/alpha.php?let='.$letter.'">'.$letter.'</A> ';}
}


function alpha_detail($lettertarget)
{

global $config;

IF ($lettertarget=='9')
$result = mysql_query("SELECT * FROM vouchers where first_letter>'1' AND first_letter<='9' AND active='1' GROUP BY merchant_name ORDER BY vid DESC");
ELSE
$result = mysql_query("SELECT * FROM vouchers where first_letter='$lettertarget' AND active='1' GROUP BY merchant_name ORDER BY vid DESC");
while($row = mysql_fetch_array($result))
  {
  echo '<H4><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">'.$row['merchant_name'].'</A></H4><br />';
  }
}


// Draw the description for a merchant
function draw_description_merchant($merchtarget)
{
global $config;
$result = mysql_query("SELECT * FROM `merchant` WHERE merchant_name = '$merchtarget'");
$num_rows = mysql_num_rows($result);
IF ($num_rows>0)
{
while($row = mysql_fetch_array($result))
  {

// THUMBSHOTS MOD
IF ($row['thumb_nail'] AND $config['showthumbs']) echo '<img src="http://open.thumbshots.org/image.aspx?url='.urlencode($row['thumb_nail']).'" ALT="'.$row['merchant_name'].' discount voucher codes" style="float:right" />';

echo $row['text_content'];

echo '<br clear="all">
';
}
}
}



// Draw the latest vouchers. Amount to display is controlled by "$numlimit". This one goes in the side menu.
function draw_latest_vouchers($numlimit)
{
global $config;
echo '<ul class="sidemenu">';
$result = mysql_query("SELECT * FROM vouchers WHERE expiry_date > now() AND active='1' AND voucher_type='1' GROUP BY merchant_name ORDER BY vid DESC LIMIT $numlimit");
while($row = mysql_fetch_array($result))
  {
	  echo '<li><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">'.$row['merchant_name'].' Voucher Code</A><br>'.substr($row['description'],0,60).'...<br><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">View Code</A></li>';
  }
echo '</ul>';
}


// Draw the latest vouchers. Amount to display is controlled by "$numlimit". This one goes in a full menu.
function draw_latest_vouchers_main($numlimit)
{
global $config;
echo '<ul class="fullsize">';
$result = mysql_query("SELECT * FROM vouchers WHERE expiry_date > now() AND active='1' AND voucher_type='1' GROUP BY merchant_name ORDER BY vid DESC LIMIT $numlimit");
while($row = mysql_fetch_array($result))
  {
	  echo '<li><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">'.$row['merchant_name'].' Voucher Code</A><br>'.substr($row['description'],0,60).'...<br><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">View Code</A></li>';
  }
echo '</ul>';
}


// Draw the vouchers which have expired recently. Amount to display is controlled by "$numlimit"
function draw_recent_expired_vouchers($numlimit)
{
global $config;
echo '<ul class="fullsize">';
$result = mysql_query("SELECT * FROM vouchers WHERE expiry_date < now() AND expiry_date > '0000-00-00' AND active='1' AND voucher_type='1' GROUP BY merchant_name ORDER BY expiry_date DESC LIMIT $numlimit");
while($row = mysql_fetch_array($result))
  {
	  echo '<li><A HREF="voucher.php?quer='.urlencode($row['merchant_name']).'">'.$row['merchant_name'].'</A><br>'.substr($row['description'],0,60).'...<br><A HREF="voucher.php?quer='.urlencode($row['merchant_name']).'">More codes by '.$row['merchant_name'].'</A></li>';
  }
echo '</ul>';
}


// Draw the vouchers which are expiring soon. Amount to display is controlled by "$numlimit"
function draw_expiring_soon_vouchers($numlimit)
{
global $config;
echo '<ul class="fullsize">';
$result = mysql_query("SELECT * FROM vouchers WHERE expiry_date > now() AND active='1' AND voucher_type='1' GROUP BY merchant_name ORDER BY expiry_date ASC LIMIT $numlimit");
while($row = mysql_fetch_array($result))
  {
	  echo '<li><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">'.$row['merchant_name'].'</A><br>'.substr($row['description'],0,60).'...<br><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">More codes by '.$row['merchant_name'].'</A></li>';
  }
echo '</ul>';
}







// Draw all the voucher codes for a particular merchant

function draw_vouchers_merchant($merchtarget)
{

global $config;
$codecount='0';


$result = mysql_query("SELECT * FROM vouchers where merchant_name = '$merchtarget' and active='1' ORDER BY voucher_type ASC, uniquecode DESC,expiry_date DESC");

while($row = mysql_fetch_array($result))
  {


// work out dates
$thisdate=strtotime("now"); 
$checkdate=strtotime($row['expiry_date']);


//SET promotext Placeholder
$promotext='';
$isexpired='';


// WORK out EXPIRED

IF ($row['expiry_date']=='0000-00-00') 
{$noexpiry='1';
$isexpired='';
}
ELSE
IF ($thisdate > $checkdate)
{
$isexpired='1';
$promotext.='Expired ';
} 


// WORK out exclusivity
IF ($row['uniquecode']=='1')
{
$isexclusive='1';
$promotext.='Exclusive ';
}
ELSE
{
$isexclusive='';
}


// Decide if is code or offer
IF ($row['voucher_type']=='1')
{
$iscode='1';
$promotext.='Voucher Code';
}
ELSE IF ($row['voucher_type']=='2')
{
$isoffer='1';
$promotext.='Special Offer';
}


// start display DIV
$working_output= '<DIV CLASS="voucher">
';

// Draw header for code or offer

IF ($isexpired) 
$working_output.='<H4 style="text-decoration: line-through; color:red;">'.$promotext.' EXPIRED</H4>';
ELSE 
$working_output.='<H4>'.$row['merchant_name'].' '.$promotext.'</H4>';

$working_output.='<P>'.$row['description'];

// Display expiry if needed
IF (!$noexpiry)
$working_output.='<BR /><SMALL>Valid: '.date("M d, Y", strtotime($row['start_date']) ).' - '.date("M d, Y", strtotime($row['expiry_date']) ).'</SMALL>';


// Draw CLIPBOARD LINK if site is active or visit site link if not
IF (!$isexpired AND $row['deeplink'] AND $iscode)
{
$working_output.="<BR />
<button align='middle' onclick='copy(\"".$row['voucher_code']."\"); window.open(\"".$row['deeplink']."\", \"CodeWindow".$row['vid']."\");'><H4>".$promotext.": ".$row['voucher_code']."</H4>".$config['buttontext']."</button>";
}
ELSE 
IF ($row['deeplink'])
$working_output.='<BR /><BIG><STRONG><A HREF="'.$row['deeplink'].'">'.$config['clicktext'].' '.$row['merchant_name'].'</A></STRONG></BIG>';

// Close paragraphs and DIV
$working_output.='</P></DIV>
';


IF ($isexpired) {$expiredlist .= $working_output;} 
ELSE IF ($isexclusive) {$exclusivelist .= $working_output; $codecount++;}
ELSE IF ($isoffer) {$offerlist .= $working_output; $codecount++;}
ELSE IF ($noexpiry) {$noexpirylist .= $working_output; $codecount++;}
ELSE {$codelist .= $working_output; $codecount++;}

// Unset variables used in the loop
unset($isexpired); unset($isexclusive); unset($iscode); unset($isoffer); unset($noexpiry);
}

IF ($exclusivelist) echo $exclusivelist;
IF ($codelist) echo $codelist;
IF ($noexpirylist) echo $noexpirylist;
IF ($offerlist) echo $offerlist;
IF ($codecount<$config['expired_display_limit'] AND $expiredlist) echo $expiredlist;

}












// Clean dates from AF XML datafeed
function dateelement ($date)
{
$dateelement=(explode('T', $date, 2));
return ($dateelement[0]);
}


// Perform the search
function search_results ($searchterm)
{

global $config;

  // Get the search variable from URL
  $var = $searchterm;
  $trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=10; 

// check for an empty string and display a message.
if ($trimmed == "")
  {
  echo "<p>Please enter a search...</p>";
  }

ELSE

// check for a search parameter
if (!isset($var))
  {
  echo "<p>We dont seem to have a search parameter!</p>";
  }

ELSE

{
// Build SQL Query  
$query = "select * from vouchers where merchant_name like \"%$trimmed%\" AND active='1' GROUP BY merchant_name order by merchant_name";

 $numresults=mysql_query($query);
 $numrows=mysql_num_rows($numresults);

// If we have no results display a message, and optionally offer a google search as an alternative

if ($numrows == 0)
  {
  echo "<h4>Results</h4>";
  echo "<p>Sorry, your search: &quot;" . $trimmed . "&quot; returned zero results</p>";

// echo "<p><a href=\"http://www.google.com/search?q=" 
//  . $trimmed . "\" target=\"_blank\" title=\"Look up " . $trimmed . " on Google\">Click here</a> to try the search on google</p>";
  }

ELSE

{

// next determine if the page number s has been passed to script, if not use 0
  if (empty($s)) {
  $s=0;
  }

// get results
  $query .= " limit $s,$limit";
  $result = mysql_query($query) or die("Couldn't execute query");

// display what the person searched for
echo "<p>You searched for: &quot;" . $var . "&quot;</p>";

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
  while ($row= mysql_fetch_array($result)) 
  {
  $title = $row["merchant_name"];
  echo '<H4><A HREF="'.$config['thissite'].'/voucher-code/'.makeurlsafe($row['merchant_name']).'">'.$row['merchant_name'].'</A></H4><br />';
  $count++ ;
  }


// Draw the voucher and merchant info if there is only one result
IF ($count=='2')
{
draw_description_merchant($title);
draw_vouchers_merchant($title);
}


$currPage = (($s/$limit) + 1);

//break before paging
  echo "<br />";

  // next we need to do the links to other results
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  print "&nbsp;<a href=\"$PHP_SELF?s=$prevs&qsearch=$var\">&lt;&lt; 
  Prev 10</a>&nbsp&nbsp;";
  }

// calculate number of pages needing links
  $pages=intval($numrows/$limit);

// $pages now contains int of pages needed unless there is a remainder from division

  if ($numrows%$limit) {
  // has remainder so add one page
  $pages++;
  }

// check to see if last page
  if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {

  // not last page so give NEXT link
  $news=$s+$limit;
  echo "&nbsp;<a href=\"$PHP_SELF?s=$news&qsearch=$var\">Next 10 &gt;&gt;</a>";
  }

}
}
}

?>