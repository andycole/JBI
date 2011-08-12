<?php
header('Content-Type: text/html; charset=utf-8');

INCLUDE ('../inc/functions.php');
require_once('xml.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Voucher List</title>
  <style type="text/css">
body {
  font-weight: normal;
  font-family: Arial,Helvetica,sans-serif;
  font-size:13px;
}

  </style>
</head>
<body>

<?PHP

FOR ($i = 0; $i < count($voucherarray); $i++)
{
print '<B>'.($voucherarray[$i][MerchantSiteName][value]).'</B>';
print ' ('.($voucherarray[$i][Status][value]).')<br>'; 
print ($voucherarray[$i][VoucherCode][value]);
print "<br>"; 
print ($voucherarray[$i][VoucherDescription][value]);
print "<br>"; 
print '<A HREF="'.($voucherarray[$i][LandingPage][value]).'">'.($voucherarray[$i][LandingPage][value]).'</A>';
print "<br>Start Date: "; 
print dateelement(($voucherarray[$i][StartDate][value]));
if ($voucherarray[$i][EndDate][value])
{
print " End Date: "; 
print dateelement(($voucherarray[$i][EndDate][value]));
}
$uniqstr=$voucherarray[$i][VoucherCode][value].'+'.$voucherarray[$i][StartDate][value].'+'.$voucherarray[$i][EndDate][value].'+'.$voucherarray[$i][MerchantSiteName][value];
print '<BR>Hash: '.md5($uniqstr);
print '<HR>';
} 

?>

</body>
</html>