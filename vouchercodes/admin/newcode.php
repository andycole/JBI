<?PHP
INCLUDE ('../inc/functions.php');
connectdata();


IF ($_GET[edit])
{

$targetvid=cleandata($_GET[edit]);

$result = mysql_query("SELECT * FROM vouchers WHERE vid='$targetvid' LIMIT 1");

while($row = mysql_fetch_array($result))
  {
  extract ($row);
  $editoverride=1;
  }
}


IF ($_POST['Submit'])
{
$sd=$_POST['start_date'];
$ed=$_POST['expiry_date'];
$desc=cleandata($_POST['description']);
$deeplink=cleandata($_POST['deeplink']);
$vtype=cleandata($_POST['vtype']);
IF ($vtype=='1') $vouchercode=cleandata($_POST['voucher_code']); 
ELSE 
{
IF ($_POST['voucher_code'])
$vouchercode=cleandata($_POST['voucher_code']);
ELSE $vouchercode='No Code Required';
}

$unique=cleandata($_POST['unique']);
$active=cleandata($_POST['active']);

// FIND OUT MERCHANT NAME
IF ($_POST['new_merchant_name'])
$merch_name=publicurlsafe($_POST['new_merchant_name']);
ELSE
$merch_name=publicurlsafe($_POST['existing_merchant_name']);


// WORK OUT FIRST LETTER OF MERCHANT, including override
IF ($_POST['firstletter']=='')
{$firstletter=strtoupper($merch_name[0]);}
ELSE
{$firstletter=strtoupper($_POST['firstletter']);}
IF ($firstletter>0 AND $firstletter<10) $firstletter='9';

$uniqstr=$vouchercode.'+'.$sd.'+'.$ed.'+'.$merch_name;
$uniqstr=md5($uniqstr);

$sql = "INSERT INTO `vouchers` (`vid`, `first_letter`, `description`, `merchant_name`, `voucher_code`, `deeplink`, `voucher_type`,`start_date`, `expiry_date`, `date_added`, `uniq-hash`, `active`, `uniquecode`, `vorigin`)
VALUES (NULL,'$firstletter', '$desc',  '$merch_name',  '$vouchercode',  '$deeplink','$vtype', '$sd', '$ed',  now(), '$uniqstr', '$active', '$unique', 'Manual')"; 
$perform_insert = mysql_query($sql) or die("<b>Data could not be entered</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

header("Location: merchant.php?editname=$merch_name&origin=edited");
echo 'loading';

}

IF ($_POST['Edit'])
{
$targetvid=$_POST['targetvid'];
$sd=$_POST['start_date'];
$ed=$_POST['expiry_date'];
$desc=cleandata($_POST['description']);
$deeplink=cleandata($_POST['deeplink']);

$vtype=cleandata($_POST['vtype']);
IF ($vtype=='1') 
$vouchercode=cleandata($_POST['voucher_code']); 
ELSE 
$vouchercode='No Code Required';

$unique=cleandata($_POST['unique']);
$active=cleandata($_POST['active']);

IF ($_POST['new_merchant_name'])
$merch_name=publicurlsafe($_POST['new_merchant_name']);
ELSE
$merch_name=publicurlsafe($_POST['existing_merchant_name']);

// WORK OUT FIRST LETTER OF MERCHANT, including override
IF ($_POST['firstletter']=='')
{$firstletter=strtoupper($merch_name[0]);}
ELSE
{$firstletter=strtoupper($_POST['firstletter']);}
IF ($firstletter>0 AND $firstletter<10) $firstletter='9';



$sql = "UPDATE `vouchers` SET `first_letter` = '$firstletter',
`description` = '$desc',
`merchant_name` = '$merch_name',
`deeplink` = '$deeplink',
`voucher_type` = '$vtype',
`start_date` = '$sd',
`expiry_date` = '$ed',
`active` = '$active',
`voucher_type` = '$vtype',
`uniquecode` = '$unique' WHERE `vid` = '$targetvid' LIMIT 1";

$perform_insert = mysql_query($sql) or die("<b>Data could not be entered</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());

unset ($targetvid);

header("Location: merchant.php?editname=$merch_name&origin=edited");
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
<CENTER>
<h1>Add / Edit Codes</H1>
<form action="newcode.php" method="POST" name="NewCode">
<div style="text-align: center;"></div>
<table style="text-align: left; margin-left: auto; margin-right: auto;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>This is a:</td>
<td>&nbsp;
<input type="radio" name="vtype" value="1" <?PHP IF ($voucher_type=='1') echo 'checked';?> > Voucher code&nbsp;&nbsp;&nbsp;
<input type="radio" name="vtype" value="2" <?PHP IF ($voucher_type=='2') echo 'checked';?> > Offer / general description</td>
</tr>
<tr>
<td>Merchant Name</td>
<td>&nbsp;<input name="new_merchant_name" value="<?PHP IF ($editoverride) echo $merchant_name; ?>">
or 
<select name="existing_merchant_name">
<OPTION value="">Choose existing merchant</OPTION>

<?PHP
$result = mysql_query("SELECT distinct merchant_name FROM vouchers ORDER BY merchant_name DESC");
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
<td>Code:</td>
<td>&nbsp;<input size="30" name="voucher_code" value="<?PHP IF ($editoverride) echo $voucher_code; ?>"></td>
</tr>
<tr>
<td>Description</td>
<td><textarea cols="50" rows="5" name="description"><?PHP IF ($editoverride) echo $description;?></textarea></td>
</tr>
<tr>
<td>Deeplink:&nbsp;</td>
<td><input size="70" name="deeplink" value="<?PHP IF ($editoverride) echo $deeplink; ?>"></td>
</tr>


<tr>
<td>Source:</td>
<td><?PHP echo $vorigin;?></td>
</tr>
<tr>
<td>Start date:</td>
<td><input name="start_date" value="<?PHP IF ($editoverride) echo $start_date; ?>"> yyyy-mm-dd</td>
</tr>
<tr>
<td>Expiry Date:&nbsp;</td>
<td><input name="expiry_date" value="<?PHP IF ($editoverride AND $expiry_date!='0000-00-00') echo $expiry_date; ?>"> yyyy-mm-dd</td>
</tr>
<tr>
<td>Active:&nbsp;</td>
<td><input name="active" type="checkbox" value="1"<?PHP IF (!$editoverride) echo ' checked'; ELSE IF ($editoverride AND $active=='1') echo ' checked'; ?>></td>
</tr>
<tr>
<td>Unique:&nbsp;</td>
<td><input name="unique" type="checkbox" value="1" <?PHP IF ($editoverride AND $uniquecode=='1') echo 'checked'; ?>></td>
</tr>
<tr>
<td>Override First letter&nbsp;</td>
<td><input maxlength="2" size="2" name="firstletter" value="<?PHP IF ($editoverride) echo $first_letter; ?>"> (use "9" for 0-9)</td>
</tr>
<tr>
<td></td>
<td>
<?PHP IF ($targetvid) echo '<INPUT TYPE="hidden" name="targetvid" value="'.$targetvid.'">';?>
<INPUT TYPE="Submit" <?PHP IF ($editoverride) echo 'name="Edit" value="Edit"'; ELSE echo 'name="Submit" value="Submit"';?>></td>
</tr>

</tbody>
</table>

</form>
</CENTER>
</body></html>