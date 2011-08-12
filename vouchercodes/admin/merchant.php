<?PHP
INCLUDE ('../inc/functions.php');
connectdata();










IF ($_GET[edit])
{

$targetid=cleandata($_GET[edit]);

$result = mysql_query("SELECT * FROM merchant WHERE id='$targetid' LIMIT 1");

$num_rows = mysql_num_rows($result);

IF ($num_rows>0)
{

while($row = mysql_fetch_array($result))
  {
  extract ($row);
  $editoverride=1;
  $targetid=$id;
  }
}
ELSE
{
unset ($_GET[edit]);
}

}

UNSET ($num_rows);

IF ($_GET[editname])
{

$targetname=cleandata($_GET[editname]);
$result = mysql_query("SELECT * FROM merchant WHERE merchant_name='$targetname' LIMIT 1");
$num_rows = mysql_num_rows($result);

IF ($num_rows>0)
{

while($row = mysql_fetch_array($result))
  {
  extract ($row);
  $editoverride=1;
  $targetid=$id;
  }
}
ELSE 
{
  $nameoverride=1;
  $merchant_name=cleandata($_GET[editname]);
}

}











IF ($_POST['Submit'])
{

$cont=cleandata($_POST['content']);

IF ($_POST['existing_merchant_name'])
{
$merch_name=cleandata($_POST['existing_merchant_name']);
}
ELSE
$merch_name=publicurlsafe($_POST['new_merchant_name']);



$result1 = mysql_query("SELECT * FROM merchant WHERE merchant_name='$merch_name' LIMIT 1");
$num_rows1 = mysql_num_rows($result1);
IF ($num_rows1>0)
{
$editnameoverride=1;
}

ELSE
{

$thumb_nail=cleandata($_POST['thumb_nail']);

$product_link=cleandata($_POST['product_link']);

$sql1 = "INSERT INTO `merchant` (`id`, `merchant_name`, `text_content`, `voucher_count`, `thumb_nail`) VALUES (NULL,'$merch_name', '$cont', '0', '$thumb_nail')";

$perform_insert = mysql_query($sql1) or die("<b>Data could not be entered</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

header("Location: viewmerchants.php");



echo 'loading';
}
}















IF ($_POST['Edit'] or $editnameoverride)
{

$targetid=cleandata($_POST['targetid']);

$cont=cleandata($_POST['content']);


IF ($_POST['existing_merchant_name'])
$merch_name=cleandata($_POST['existing_merchant_name']);
ELSE
$merch_name=publicurlsafe($_POST['new_merchant_name']);


$thumb_nail=cleandata($_POST['thumb_nail']);

$product_link=cleandata($_POST['product_link']);

$sql = "UPDATE `merchant` SET `merchant_name` = '$merch_name',`text_content` = '$cont', `thumb_nail` = '$thumb_nail' WHERE `id` = '$targetid'";

$perform_insert = mysql_query($sql) or die("<b>Data could not be entered</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

unset ($targetid);

header("Location: viewmerchants.php");

echo 'loading';

}

?>









<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><title>AF Voucher System</title>
<STYLE>
body {font-family: Helvetica,Arial,sans-serif;}
</STYLE>
</head><body>

<?PHP INCLUDE ('header.php');?>
<center>
<H1>Manage Merchant Info</H1>
<?PHP IF ($_GET['origin']=='edited') echo '<P>Thanks for updating the voucher. Please review and update the info associated with the merchant.</P>'; ?>
<form action="merchant.php" method="POST" name="Merchant">
<div style="text-align: center;"></div>
<table style="text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>Merchant Name</td>
<td>&nbsp;<input length="100" name="new_merchant_name" value="<?PHP echo $merchant_name; ?>">
or 
<select name="existing_merchant_name">
<OPTION value="">Choose existing merchant</OPTION>

<?PHP
$result = mysql_query("SELECT distinct merchant_name FROM vouchers ORDER BY merchant_name ASC");
while($row = mysql_fetch_array($result))
  {
  echo '<OPTION value="'.$row['merchant_name'].'">'.$row['merchant_name'].'</OPTION>
';
  }
?>

</select>
</td>
</tr>
<tr>
<td valign="top">Description</td>
<td><textarea cols="80" rows="15" name="content"><?PHP IF ($editoverride) echo $text_content;?></textarea></td>
</tr>

<tr>
<td>Web address</td>
<td><input length="100" name="thumb_nail" value="<?PHP IF ($editoverride) echo $thumb_nail;?>"><br><SMALL>Providing this address extracts a Website thumbnail and meta description from the target site.<BR>The page title is used if meta description is not present, and you can override it by entering something manually in the description box.</SMALL></td>
</tr>

<tr>
<td></td>
<td>
<?PHP IF ($targetid) echo '<INPUT TYPE="hidden" name="targetid" value="'.$targetid.'">';?>
<INPUT TYPE="Submit" <?PHP IF ($editoverride) echo 'name="Edit" value="Edit"'; ELSE echo 'name="Submit" value="Submit"';?>></td>
</tr>
</tbody>
</table>

</form>
</CENTER>























<?PHP 
IF ($_GET['editname'])
{
?>



<center>

<h2>View All Codes</H2>

<?PHP

$result = mysql_query("SELECT * FROM vouchers WHERE merchant_name='$_GET[editname]'");

echo '<table cellspacing="4" cellpadding="4" BORDER="1" align="center"><tr><TH></TH><TH>ID</TH><th>Merchant</th><th>Code</th><th>Start</th><th>Expiry</th><th>Actions</th></TR>';
$bgcol="green";

while($row = mysql_fetch_array($result))
  {
  IF ($row['active']=='1') $bgcol='green'; ELSE $bgcol='red';
  echo '
  <TR><TD width="6" BGCOLOR="'.$bgcol.'"></TD><TD>'.$row['vid'].'</TD><TD>'.$row['merchant_name'].'</TD><TD>'.$row['voucher_code'].'</TD><TD>'.$row['start_date'].'</TD><TD>';



IF ($row['expiry_date']!="0000-00-00") 
{

$thisdate=strtotime("now");
$checkdate=strtotime($row['expiry_date']);
IF ($thisdate > $checkdate){echo '<s>'.$row['expiry_date'].'</S>';} ELSE {echo $row['expiry_date'];}
}
ELSE 
echo '&nbsp;'; 


  echo '</TD><TD><A HREF="newcode.php?edit='.$row['vid'].'">Edit</A></TD></TR>
  ';
  UNSET ($bgcol);
  }

echo '</TABLE>';
?>
</CENTER>


<?PHP 
}
?>










</body></html>