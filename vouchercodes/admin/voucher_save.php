<?php
header('Content-Type: text/html; charset=utf-8');

INCLUDE ('../inc/functions.php');
require_once('xml.php');

connectdata();
 
$query = "SELECT * FROM vouchers"; 
	 
$result = mysql_query($query) or die(mysql_error());

$hasharray = array();
$incount=0;
$newcount=0;

while($row = mysql_fetch_array($result))
{
$hasharray[] = $row['uniq-hash'];
}

FOR ($i = 0; $i < count($voucherarray); $i++)
{

if (!$voucherarray[$i][MerchantSiteName][value]=='')

{
$uniqstr=$voucherarray[$i][VoucherCode][value].'+'.$voucherarray[$i][StartDate][value].'+'.$voucherarray[$i][EndDate][value].'+'.$voucherarray[$i][MerchantSiteName][value];
$uniqstr=md5($uniqstr);

IF (in_array($uniqstr,$hasharray))
{
$incount++;
//echo $voucherarray[$i][VoucherCode][value].' - '.$voucherarray[$i][MerchantSiteName][value].'<br>';
}
ELSE
{
$sd=dateelement($voucherarray[$i][StartDate][value]);
$ed=dateelement($voucherarray[$i][EndDate][value]);
$desc=cleandata($voucherarray[$i][VoucherDescription][value]);
$merch_name=publicurlsafe($voucherarray[$i][MerchantSiteName][value]);
$merch_id=cleandata($voucherarray[$i][MerchantSiteID][value]);
$prog_id=cleandata($voucherarray[$i][ProgrammeID][value]);
$deeplink=cleandata($voucherarray[$i][LandingPage][value]);
$vouchercode=cleandata($voucherarray[$i][VoucherCode][value]);

$firstletter=strtoupper($merch_name[0]);
IF ($firstletter>0 AND $firstletter<10) $firstletter='9';

$sql = "INSERT INTO `vouchers` (`vid`, `first_letter`, `description`, `merchant_name`, `voucher_code`, `deeplink`, `voucher_type`, `start_date`, `expiry_date`, `date_added`, `uniq-hash`, `active`, `uniquecode`, `vorigin`) 
VALUES (NULL,'$firstletter', '$desc',  '$merch_name',  '$vouchercode',  '$deeplink' ,'1', '$sd', '$ed',  now(), '$uniqstr', '1', '0', 'AF XML Feed')"; 
$perform_insert=mysql_query($sql);
echo $voucherarray[$i][VoucherCode][value].' - '.$voucherarray[$i][MerchantSiteName][value].'<br />';
$newcount++;
}

}

}
closedata();
echo $incount.' skipped '.$newcount.' entered';
echo '<P><A HREF="index.php">Back to admin</A></P>';

?>