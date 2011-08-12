<?PHP header('Content-Type: text/html; charset=utf-8'); 
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

<CENTER>
<h1>Edit Merchant Info</H1>

<?PHP



$result = mysql_query("SELECT distinct merchant_name FROM merchant ORDER by merchant_name");

echo '<table cellspacing="4" cellpadding="4" BORDER="1" align="center"><tr><th>Merchant</th><th>Actions</th></TR>';

while($row = mysql_fetch_array($result))
  {
  echo '<TR><TD>'.$row['merchant_name'].'</TD><TD><A HREF="merchant.php?editname='.urlencode(cleandata($row['merchant_name'])).'">Edit Info</A></TD></TR>';
  }
echo '</TABLE>';
?>

<P><A HREF='merchant.php'>Click here to add new merchant info</A></P>
</CENTER>

<br>
</body></html>