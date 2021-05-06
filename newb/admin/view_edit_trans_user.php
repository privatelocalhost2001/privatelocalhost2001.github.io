<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/config.php');
require('../things/sources/ipb.php');
if(isset($_GET['action'])){
$delT = $conn->query("delete from credit_info where transact_id = '" . $_GET['id'] . "'") or die($conn->error);
header("location:view_transact_info.php?msg=Transaction has been successfully removed&acct_nmb=". $_GET['acct_nmb']);
}

?>


<?php
 $sql = $conn->query("UPDATE credit_info
SET credit_info.email=(SELECT customer_info.email
  FROM customer_info
  WHERE customer_info.acct_nmb=credit_info.accnt_nmb)") or die($conn->error); 
?>





<?php
if(isset($_GET['action1'])){

    $selAmt = $conn->query("select * from credit_info where transact_id = '" . $_GET['id'] . "'") or die(mysql_error());
$rowAmt = $selAmt->fetch_assoc();
    
    
    
    
    //CURRENCE
$selcuuu = $conn->query("select * from curr_type where accnt_nmb = '" . $rowAmt['accnt_nmb'] . "'") or die(mysql_error());
$rowCrrr = $selcuuu->fetch_assoc();
$currr = $rowCrrr['curr_type']; 
    
    
    
    // TOTAL BALANCE
   $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowAmt['accnt_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc(); 
   $total = number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ',');
    
    

// SHOW CREDIT OR DEBIT ON EMAIL
if( $rowAmt['trans_type']=="Credit"){
   $trans_head = "Credited"; 
    
 $amt_credit = $rowAmt['amt_cred'];    
  $amt_debit = '';
    
}else{  
    $trans_head = "Debited";
    $amt_debit = $rowAmt['amt_dep'];
    $amt_credit = ''; 
    }
    
    
   
    
    


 
// To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers = "From:'Alert....  $site_name'<alert@$domain>\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$trans_id = substr(time()*rand(), 0, 14);
// Create email headers
    
    
    
$to = $rowAmt['email'];
$subject = "Transaction Alert [ $trans_head:  $amt_credit $amt_debit $currr] ";
$headers .= "Bcc: aturosandaval@gmail.com \r\n";



        
        
        // Admin email hearders
$subject2 = "TRANSACTION RECEIPT";
$headers2 = "From:'Transfer Fom  $site_name'<transfer@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
 

// Compose a simple HTML email message
$message2 = '<html><body>';
$message2 .= '<div><span style="color:#003399; font-size:16px; font-weight:600;">TRANSACTION ID: </span>'. $trans_id .' </div>';
$message2 .= '<p style="color:#080;font-size:14px; font-family:Helvetica; padding;9px; margin:10px 0px 10px 0px;">Hello Admin the following receipt was sent</p>';
$message2 .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
$message2 .= '<p style="color:#003399;font-size:18px;">Beneficiary Name:<span style="color:#990000; font-size:16px; font-weight:200;"> ' . $rowAmt['payee_name'] . '</span> 
<br>Customer name: <span style="color:#990000; font-size:16px; font-weight:200;">'. $rowAmt['cust_name'] . '</span>
<br>Customer Account Number: <span style="color:#990000; font-size:16px; font-weight:200;">'. $rowAmt['accnt_nmb'] . '</span>
<br>Narative: <span style="color:#990000; font-size:16px; font-weight:200;"> '. $rowAmt['payee_name'] . '/'. $rowAmt['narratn'] . '</span>
<br>Amount: <span style="color:#990000; font-size:16px; font-weight:200;"> '. $amt_credit . '  ' . $amt_debit . '  ' .$rowCrrr['curr_type']. '</span>
<br>Sender Name: <span style="color:#990000; font-size:16px; font-weight:200;">'. $rowAmt['payee_name'] . '</span>
<br>Sender account number: <span style="color:#990000; font-size:16px; font-weight:200;">'. $rowAmt['payee_accnt'] . '</span>
<br>Transaction Time: <span style="color:#990000; font-size:16px; font-weight:200;">'. $rowAmt['dat_pay'] . '</span>

<br>Recept Sending Time Date:  <span style="color:#990000; font-size:16px; font-weight:200;"> '.$adddate.'</span> </p>';
$message2 .='</div>';
$message2 .= '<div style="padding:9px;">';
$message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Problems with trasaction ? </p>';
$message2 .= '</div>';
$message2 .= '</body></html>';
    
    
    
    
 // customer message 
$message = '<html><body>';
$message .= '<div >';
$message .='<p>&nbsp;</p>
<div style="font-size: 15px; font-family: Roboto, sans-serif; vertical-align: baseline; white-space: normal; word-spacing: 0px; text-transform: none; font-weight: 400; color: #6d00f6; font-style: normal; orphans: 2; widows: 2; margin: 0px; letter-spacing: normal; background-color: #ffffff; text-indent: 0px; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; border: 0px; padding: 0px;">
<div style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;">&nbsp;</div>
</div>
<div id="x_yiv3493443267" style="font-size: 15px; border-top: 0px;">
<div style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;"><center style="width: 725px; margin: 0px; background-color: #f3f3f3; padding: 0px;">
<div class="x_yiv3493443267email-container" style="max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table style="margin: 0px auto;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="white-space: normal !important; text-align: right; padding: 0px;"><img style="height: 89px; width: 129px;" src="'.$site_url.'/things/img/logo.png" width="100" height="99" /></td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">
<h2 style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Dear '. $rowAmt['cust_name'] . ',</h2>
<center>
<h3 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Your account has been '.$trans_head.'</h3>
<h1 style="font-size: 30px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;"><span style="font-size: 30px; font-family: inherit; vertical-align: baseline; font-weight: 600; margin: 0px; line-height: 30px; font-stretch: inherit; border: 0px; padding: 0px;"> '. $amt_credit . ' ' . $amt_debit . ' ' .$rowCrrr['curr_type']. '</span></h1>
</center></td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;"><center>
<h3 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Kindly click to rate your experience with This Bank</h3>
<div style="overflow: auto; max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table style="max-width: 450px; width: 450px;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 120px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" href="'.$site_url.'/alart-rate-us"><img id="x_ymail_ctr_id_-94339-49" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/Good.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Good</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 120px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" href="'.$site_url.'/alart-rate-us"><img id="x_ymail_ctr_id_-307610-50" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/skeptical.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Fair</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 120px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" href="'.$site_url.'/alart-rate-us"><img id="x_ymail_ctr_id_-717384-51" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/Bad.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Bad</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</center></td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">
<h2 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Transaction Summary</h2>
<div style="overflow: auto; max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table style="width: 640px; background: #efefef;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">A/C Number</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">'. $rowAmt['accnt_nmb'] . '</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Account Name</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">'. $rowAmt['cust_name'] . '</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Description</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">'. $rowAmt['payee_name'] . ' / '. $rowAmt['narratn'] . '</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Reference Number</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">9766557643457</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Transaction Branch</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">HEAD OFFICE</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Transaction Date</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">'. $rowAmt['dat_pay'] . '</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Value Date</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">'. $rowAmt['dat_pay'] . '</td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Available Balance</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">' .$rowCrrr[curr_type]. ' '.$total.'</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">
<h2 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Recent Transactions</h2>
<div style="overflow: auto; max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="font-size: 12px;">
<td style="width: 87px; white-space: normal !important; background-color: #f5f6fa; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 10.5pt; border-top: 0px;">Date</span></p>
</td>
<td style="width: 322px; white-space: normal !important; background-color: #f5f6fa; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 10.5pt; border-top: 0px;">Narrative</span></p>
</td>
<td style="width: 86px; white-space: normal !important; text-align: center; background-color: #f5f6fa; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 10.5pt; border-top: 0px;">Type</span></p>
</td>
<td style="width: 105px; white-space: normal !important; text-align: right; background-color: #f5f6fa; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 10.5pt; border-top: 0px;">Amount</span></p>
</td>
</tr>
<tr>
<td style="border-top-style: none; border-left-style: none; width: 87px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 7pt; border-top: 0px;">'. $rowAmt['dat_pay'] . '</span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 322px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 7pt; border-top: 0px;">'. $rowAmt['dat_pay'] . '/'. $rowAmt['payee_name'] . ' /'. $rowAmt['narratn'] . '</span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 86px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; text-align: center; margin: 0px; line-height: 15pt;" align="center"><span style="font-size: 7pt; border-top: 0px;"><img id="x_yiv3493443267_x0000_i1029" style="width: 5.49pt; vertical-align: baseline; min-height: 8.49pt; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/up.png" alt="CR" border="0" /></span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 105px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; margin: 0px; line-height: 15pt;" align="right"><span style="font-size: 7pt; border-top: 0px;"> ' .$rowCrrr[curr_type]. ' '. $amt_credit . ' ' . $amt_debit . ' </span></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 680px; width: 680px; white-space: normal !important;" width="680">
<table style="max-width: 680px; height: auto; width: 680px;" border="0" width="680" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 680px; height: auto; width: 680px; white-space: normal !important;" width="680" height="110"><img id="x_ymail_ctr_id_-927302-53" style="max-width: 680px; height: auto; width: 680px; vertical-align: baseline; margin: 0px; display: block; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/awards.png" alt="14 years, many lives touched, 14 awards received." width="680" height="110" border="0" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 680px; width: 680px; white-space: normal !important;" width="680">
<table style="max-width: 680px; height: auto; width: 680px;" border="0" width="680" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 680px; height: auto; width: 680px; white-space: normal !important;" width="680" height="120"><img id="x_ymail_ctr_id_-63525-54" style="max-width: 680px; height: auto; width: 680px; vertical-align: baseline; margin: 0px; display: block; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/rednote.png" alt="Never disclose your internet banking password" width="680" height="120" border="0" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<table style="background-color: #5b6570;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="white-space: normal !important;" valign="top">
<div class="x_yiv3493443267email-container" style="max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;" align="center">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top">
<table style="table-layout: auto; margin: auto;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="white-space: normal !important; padding: 0px 5px 0px 0px;"><a style="font-size: 12px; border-top: 0px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" href="'.$site_url.'">Home</a></td>
<td style="white-space: normal !important; padding: 0px 5px 0px 5px;"><a style="font-size: 12px; border-top: 0px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" href="mailto:support@'.$domain.'">Customer Care</a></td>
<td style="white-space: normal !important; padding: 0px 5px 0px 5px;"><a style="font-size: 12px; border-top: 0px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" href="v">*901#</a></td>
<td style="white-space: normal !important; padding: 0px 0px 0px 5px;"><a style="font-size: 12px; border-top: 0px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" href="'.$site_url.'">'.$site_name.' Internet Banking </a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top">
<table style="table-layout: auto; margin: auto;" border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="white-space: normal !important;">
<div style="max-width: 340px; width: 340px; vertical-align: top; margin: 0px; display: inline-block; border: 0px; padding: 0px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" rel="noopener"><img id="x_ymail_ctr_id_-709640-55" style="max-width: 340px; width: 340px; vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/mandatory.png" width="340" /></a></div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top">
<table style="table-layout: auto; margin: auto; width: 183.5px;" border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding: 0px 10px 0px 0px; white-space: normal !important; width: 16px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" href="https://facebook.com"><img id="x_ymail_ctr_id_-840262-56" style="vertical-align: baseline; float: left; min-height: 24px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/facebook.png" height="24" /></a></td>
<td style="padding: 0px 10px; white-space: normal !important; width: 16px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" href="https://twitter.com"><img id="x_ymail_ctr_id_-798136-57" style="vertical-align: baseline; float: left; min-height: 24px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/twitter.png" height="24" /></a></td>
<td style="padding: 0px 10px; white-space: normal !important; width: 16px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" href="https://instagram.com"><img id="x_ymail_ctr_id_-89913-58" style="vertical-align: baseline; float: left; min-height: 24px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/insta.png" height="24" /></a></td>
<td style="padding: 0px 0px 0px 10px; white-space: normal !important; width: 16px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" href="https://youtube.com"><img id="x_ymail_ctr_id_-883524-59" style="vertical-align: baseline; float: left; min-height: 24px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/youtube.png" height="24" /></a></td>
<td style="padding: 0px 10px; white-space: normal !important; width: 16px;"><a style="vertical-align: baseline; margin: 0px; border: 0px; padding: 0px;" href="https://linkedin.com"><img id="x_ymail_ctr_id_-235651-60" style="vertical-align: baseline; float: left; min-height: 24px; margin: 0px; border: 0px; padding: 0px;" src="'.$site_url.'/things/img/linkedin.png" height="24" /></a></td>
</tr>
</tbody>
</table>
&nbsp;<span style="color: #999999;"><span style="font-size: 8pt;">For more information on our products and services, please call our 24/7</span><span style="font-size: 8pt;"><br />contact centre on&nbsp; '.$admin_email.'&nbsp;&nbsp;or chat with us via&nbsp;&nbsp;</span><span style="font-size: 8pt;">Whatsapp on&nbsp;'.$admin_phone.'&nbsp;</span></span></td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</center><span style="font-size: 9pt;"><strong>Copyright &copy; 2020.&nbsp;'.$site_name.'&nbsp;</strong></span></div>
</div>';
$message.='</div>';
$message .= '<div style="padding:9px;">';
$message .= '</div>';
$message .= '</body></html>';  
  
    
    
 
// Sending email
    {   
    mail($admin_email,$subject2,$message2,$headers2);
    }
if(mail($to,$subject,$message,$headers)){
   
header("location:view_transact_info.php?msg=Transaction alert has been sent successfully&acct_nmb=". $_GET['acct_nmb']);

}
}
?>






<?php include 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
<div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                
                 <?php 
                
                $selCuInfo = $conn->query("select * from customer_info where acct_nmb = '" . $_GET['acct_nmb'] . "'") or die($conn->error);
                $rowCuInfo = $selCuInfo->fetch_array()
                ?>
                
              <li class="pull-left header"><i class="fa fa-inbox"></i> <?php echo $rowCuInfo['cust_name']; ?> Tansactions</li>
            </ul>
              
              
                <?php
                 //CURRENCE
$selC = $conn->query("select * from curr_type where accnt_nmb = '" . $_GET['acct_nmb'] . "'") or die(mysql_error());
$rowC = $selC->fetch_assoc();
$myC = $rowC['curr_type']; 
              
    // TOTAL BALANCE
   $selT = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $_GET['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowT = $selT->fetch_assoc(); 
   $myT = number_format($rowT['totalCredit']-$rowT['totalDebit'], 2, '.', ',');
             
            ?>   
              
              <div ><strong style="color: red;">Available balance: </strong><span><?php echo $myC; ?> <?php echo $myT; ?> </span></div>

                 
              
               <button  class="pull-right"><div align="right" class="pull-right" ><a href="more_info.php?id=<?php echo $rowCuInfo['customer_id']; ?>">Back To User Info =></a></div></button>
              
              
            <div class="tab-content no-padding">
              <div style="margin:20px 0px 0px 10px;" class="RadGrid RadGrid_MetroTouch table-responsive">     
                          <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                          <table width="100%" align="center" cellpadding="3" cellspacing="1" bgcolor="#013694">
                  <tr>
                  <th height="34" bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    
                      No
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Payee/Recipient Name
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Customer Name
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Account Number
                  </div></th>
                   <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                     Transaction
                      </div></th>
                   <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                     Credit
                   </div></th>
                   <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Debit
                     </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Date                 
                     </div></th>
                     <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                   &nbsp;                 
                     </div></th>
                   </tr>
                  <?php
				  $i=0;
				  $seLInfo = $conn->query("select * from credit_info where accnt_nmb = '" . $_GET['acct_nmb'] . "'") or die($conn->error);
                  if(!$seLInfo->num_rows){
				  ?>
                  <tr>
                  <td height="37" colspan="8" bgcolor="#FFFFFF">This customer have not made any transaction. </td>
                  </tr>
                  <?php
				  }else{
                  
				  while($rowInfo = $seLInfo->fetch_array()){
				  $i++;
				  ?>
				  <tr style="border-bottom:1px solid #666666;">
                  <td height="29" bgcolor="#FFFFFF"><div align="left"><?php echo $i; ?></div></td>
                  <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['payee_name']; ?></div></td>
                   <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['cust_name']; ?></div></td> 
                   <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['accnt_nmb']; ?></div></td> 
					 <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['trans_type']; ?></div></td> 
					 <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['amt_cred']; ?></div></td> 
                     <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['amt_dep']; ?></div></td> 
                     <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowInfo['dat_pay']; ?></div></td> 
                      
                      
                       <td bgcolor="#FFFFFF"><div align="left"><a href="view_edit_trans_user_edit.php?&transact_id=<?php echo $rowInfo['transact_id']; ?>">Edit Transaction</a></div></td> 
                                       
                      
                      <td bgcolor="#FFFFFF"><div align="left"></div></td>
                    </tr>
                    
					<?php
					}
					}
					?>	
                    </table>          
            </div>
              
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            
            
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <!-- /.box (chat box) -->
          <!-- TO DO List -->
          <!-- /.box -->
          <!-- quick email widget -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <!-- /.box -->
          <!-- Calendar -->
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://adminlte.io"><?php echo $site_name ; ?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
