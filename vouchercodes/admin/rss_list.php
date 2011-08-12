<?PHP 
header('Content-Type: application/xml; charset=utf-8');
echo '<';
echo '?';
echo 'xml version="1.0" encoding="utf-8"';
echo '?';
echo '>';
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<?php

$finaloutput='';

INCLUDE ('../inc/functions.php');
require_once('xml.php');

?>

<title>Affiliate Future Voucher Feed</title>
<link>http://www.affiliatefuture.co.uk</link>
<description>All vouchers from AF</description>
<lastBuildDate><?PHP echo date('D, d M Y H:i:s'); ?> GMT</lastBuildDate>
<language>en-uk</language>

<atom:link href="http://blog.affiliatefuture.co.uk/rss_output/rss_list.php" rel="self" type="application/rss+xml" />

<?PHP

FOR ($i = 0; $i < count($voucherarray); $i++)
{

IF ($voucherarray[$i][Status][value]=="Active")
{
$thisoutput='';

$sd=dateelement($voucherarray[$i][StartDate][value]);

$thisoutput.= '
<item>
<title>New '.$voucherarray[$i][MerchantSiteName][value].' Voucher Code</title>';
$showdesc=strip_tags($voucherarray[$i][VoucherDescription][value]);

$thelink=htmlspecialchars("http://afuk.affiliate.affiliatefuture.co.uk/");

$thisoutput.='<link>'.$thelink.'</link>
';

$thisoutput.='
<pubDate>'.date("D, d M Y H:i:s", strtotime($sd) ).' GMT</pubDate>';

$thisoutput.='
<description><![CDATA[ '.htmlspecialchars($showdesc);
$thisoutput.='

Code: '. $voucherarray[$i][VoucherCode][value] .' 
Start Date: '; 
$thisoutput.=date("M d, Y", strtotime($sd) );

if ($voucherarray[$i][EndDate][value])
{
$ed=dateelement($voucherarray[$i][EndDate][value]);

$thisoutput.="
End Date: ";

$thisoutput.=date("M d, Y", strtotime($ed) );

}
$thisoutput.='

Log in to the new AffiliateFuture tools to access the voucher manager and view all available codes.

 ]]></description>';
$thisoutput.='
</item>
';

$finaloutput=$thisoutput.$finaloutput;

}
}
echo $finaloutput;
?>



</channel>
</rss>