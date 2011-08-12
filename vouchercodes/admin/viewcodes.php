<?PHP
header('Content-Type: text/html; charset=utf-8');
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
<center>
<h1>View All Codes</H1>
<?PHP

$result = mysql_query("SELECT * FROM vouchers ORDER BY merchant_name ASC");

echo '<table cellspacing="4" cellpadding="4" BORDER="1" align="center"><tr><TH></TH><TH>ID</TH><th>Merchant</th><th>Code</th><th>Start</th><th>Expiry</th><th>Actions</th></TR>';
$bgcol="green";
while($row = mysql_fetch_array($result))
  {
  IF ($row['active']=='1') $bgcol='green'; ELSE $bgcol='red';
  echo '
  <TR><TD width="6" BGCOLOR="'.$bgcol.'"></TD><TD>'.$row['vid'].'</TD><TD><A HREF="merchant.php?editname='.urlencode(cleandata($row['merchant_name'])).'">'.$row['merchant_name'].'</A></TD><TD>'.$row['voucher_code'].'</TD><TD>'.$row['start_date'].'</TD><TD>';



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
<br>
</body></html>