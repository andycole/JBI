<?PHP 
INCLUDE ('../inc/functions.php');
connectdata();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><title>AF Voucher System</title>
<STYLE>
body {font-family: Helvetica,Arial,sans-serif;}
</STYLE>
</head><body>

<?PHP INCLUDE ('header.php');?>

<table style="text-align: left; width: 80%;" align="center" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<th style="width: 33%;">Manage Vouchers</th>
<th style="width: 33%;">Stats</th>
<th style="width: 33%;">AF XML Feed</th>
</tr>
<tr>
<td style="width: 33%; text-align: left; vertical-align: top;"><a href="newcode.php">Add
New Code</a><br>
<a href="viewcodes.php">List Vouchers</a><br>
<a href="viewmerchants.php">Manage Merchant Info</a><br>




</td>
<td style="width: 33%; text-align: left; vertical-align: top;">




<P>
<?php
$query = "SELECT active, COUNT(active) AS counter FROM vouchers where expiry_date>now() OR expiry_date='0000-00-00' GROUP BY active ORDER BY active DESC"; 
$result = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($result)){
echo number_format($row['counter']);
IF ($row['active']=='0') echo " hidden<br />"; ELSE echo " active <br />";
}
?>
</P>




<P>
Expiring Soon:<br />
<?php
$query = "SELECT vid, voucher_code, merchant_name FROM vouchers ORDER BY expiry_date DESC LIMIT 20"; 
$result = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($result)){
echo '<SMALL>'.$row['merchant_name'].' - '.$row['voucher_code'].'</SMALL><br />';
}
?>
</P>




</td>
<td style="width: 33%; text-align: left; vertical-align: top;">




<P>
<a href="voucher_save.php">Update system from AF XML Feed</a>
<br><a href="voucher_list.php">View XML Feed contents</a>
<br><a href="voucher_array.php">View PHP array of xml data</a>
<br><a href="rss_list.php">View RSS feed of xml data</a>
</P>




<P>
Latest AF codes:<br />
<?php
$query = "SELECT vid, voucher_code, merchant_name FROM vouchers WHERE vorigin='AF XML Feed' ORDER BY vid DESC LIMIT 10"; 
$result = mysql_query($query) or die(mysql_error());
// Print out result
while($row = mysql_fetch_array($result)){
echo '<SMALL>'.$row['merchant_name'].' - '.$row['voucher_code'].'</SMALL><br />';
}
?>
</P>




</td>
</tr>
</tbody>
</table>
<br>
</body></html>