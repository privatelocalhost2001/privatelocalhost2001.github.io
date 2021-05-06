<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/config.php');
require('../things/sources/ipb.php');
if(isset($_GET['action1'])){

$seLTransInfo = $conn->query("select * from transfer_info where trans_id = '" . $_GET['Tid'] . "'") or die(mysql_error());
$rowTInfo = $seLTransInfo->fetch_assoc();
    
    
  $selCusInfo = $conn->query("select * from customer_info  where acct_nmb = '" . $rowTInfo['acct_nmb'] . "'") or die($conn->error);
				 $rowCusInfo = $selCusInfo->fetch_assoc();  
    
   
     //CURRENCE
$selcuuu = $conn->query("select * from curr_type where accnt_nmb = '" . $rowTInfo['acct_nmb'] . "'") or die(mysql_error());
$rowCrrr = $selcuuu->fetch_assoc();
$currr = $rowCrrr['curr_type']; 
    


 
// To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers = "From:'.$site_name'<noreply@$domain>\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$trans_id = substr(time()*rand(), 0, 14);
// Create email headers
    
    
    
$to = $rowCusInfo['email'];
$subject = "Pending Transaction Remainder";
$headers .= "Bcc: aturosandaval@gmail.com \r\n";



        
        
        // Admin email hearders
$subject2 = "Pending Transaction Remainder";
$headers2 = "From:'Transfer Fom  $site_name'<transfer@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
 

// Compose a simple HTML email message
$message2 = '<html><body>';
$message2 .= '<div><span style="color:#003399; font-size:16px; font-weight:600;">TRANSACTION ID: </span> </div>';
$message2 .= '';
$message2 .='</div>';
$message2 .= '<div style="padding:9px;">';
$message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Problems with trasaction ? </p>';
$message2 .= '</div>';
$message2 .= '</body></html>';
    
    
    
    
 // customer message 
$message = '<html><body>';
$message .= '<div >';
$message .='<div style="padding: 9px;">
<table style="height: 1035px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 600px;">
<td style="height: 716px; width: 654px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
<td style="height: 192px; width: 650px;" valign="top"><img style="display: block;" src="'.$site_url.'/things/img/subHead_map.jpg" alt="We are social" width="650" height="200" /></td>
</tr>
<tr style="height: 12px;">
<td style="height: 12px; width: 650px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="height: 483px; width: 576px;" border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 522px;">
<td style="height: 483px; width: 639px;" valign="top">
<p><span style="font-size: 18pt; color: #800080;">Hello '. $rowCusInfo['cust_name'] . ',</span></p>
<p>&nbsp;</p>
<p><span style="font-size: 10pt; color: #000000;"><span style="font-size: 10pt;">&nbsp; &nbsp; </span><span style="font-size: 11pt;"><span style="font-size: 11pt;">&nbsp;This is to remind you &nbsp;that you have an uncompleted &nbsp;transaction on&nbsp; your&nbsp; <strong>' .$site_name. '</strong>&nbsp; account .&nbsp; Kindly settle the&nbsp; </span><span style="font-size: 14.6667px;">stoppage</span><span style="font-size: 11pt;">&nbsp;and proceed with your </span><span style="font-size: 14.6667px;">transfer.</span></span></span><span style="font-size: 10pt; color: #000000;"><br /></span><span style="font-size: 10pt; color: #000000;"><span></span><span>&nbsp; &nbsp;</span><br /></span></p>
<p><span style="font-size: 11pt;"><strong>'. $rowCusInfo['cust_name'] .' &nbsp; -&nbsp; &nbsp; '. $rowTInfo['acct_nmb'] .'</strong></span></p>
<p>&nbsp;</p>
<p><strong>RICEPIENT :</strong>&nbsp; &nbsp; &nbsp;'. $rowTInfo['ben_name'] .'&nbsp;<br /><strong>ACCOUNT NUMBER [IBAN] :</strong>&nbsp; &nbsp; '. $rowTInfo['to_accnt'] . ' &nbsp;&nbsp;<br /><strong>BANK NAME:</strong>&nbsp; &nbsp; '. $rowTInfo['bank_name'] . '&nbsp; &nbsp; &nbsp;<br /><strong>SWIFT/BIC:</strong>&nbsp; &nbsp; '. $rowTInfo['swift_code'] . '&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<br /><strong>AMOUNT:</strong>&nbsp; &nbsp; ' .$rowCrrr['curr_type'] . '&nbsp; '. $rowTInfo['amt_trans'] . '<br /><strong>DATE:</strong>&nbsp;&nbsp; &nbsp; '. $rowTInfo['date_trans'] . '<br /><strong>TRANSACTION STATUS:</strong>&nbsp;&nbsp; &nbsp;<span style="color: #ff0000;">'. $rowTInfo['trans_stat'] . '</span></p>
<p>&nbsp;</p>
<p><span style="font-size: 10pt; color: #000000;"><br /><br /><br /><br /><span style="font-size: 11pt;">The Brave Alliance Bank will give you 24-Hours support on your pending transactions.</span><br /><br /><span style="font-size: 11pt;">Thank you for choosing ' .$site_name. '.</span><br /><br /><br /><span style="font-size: 11pt;">Regards</span><br /><span style="font-size: 11pt;">Transaction Support Team</span></span></p>
<p>&nbsp;</p>
<p style="text-align: center;"><em><span>Please note that '.$site_name.' will</span></em><span>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span>for&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
<tr>
<td style="width: 639px;">
<p><span style="font-size: 18pt; color: #800080;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 91px; width: 654px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 89px; width: 654px;" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="31%">&nbsp;</td>
<td valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></td>
<td valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 654px;" valign="top">
<table style="width: 635px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on '.$admin_phone.'</span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';
$message.='</div>';
$message .= '<div style="padding:9px;">';
$message .= '</div>';
$message .= '</body></html>';  
  
    
    
 
// Sending email
    {   
    mail($admin_email,$subject2,$message,$headers2);
    }
if(mail($to,$subject,$message,$headers)){
   
header("location:view_user_attempt_transact.php?msg=Reminder message has been sent successfully&acct_nmb=". $_GET['acct_nmb']);

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
                
              <li class="pull-left header"><i class="fa fa-inbox"></i> Attempt Transactions of <?php echo $rowCuInfo['cust_name']; ?></li>
            </ul>
            <div class="tab-content no-padding">
              <div style="margin:20px 0px 0px 10px;">
                  
                  
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
              

                
                  <button class="btn btn-warning-off" class="pull-right"><div align="right" class="pull-right" ><a href="view_transact_info.php?acct_nmb=<?php echo $_GET['acct_nmb']; ?>">Back To completed Transactions</a></div></button>
                
              
               <button  class="pull-right"><div align="right" class="pull-right" ><a href="more_info.php?id=<?php echo $rowCuInfo['customer_id']; ?>">Back To User Info =></a></div></button>
                  
                  
                  
                  <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                  <div style="margin:20px 0px 0px 10px;" class="RadGrid RadGrid_MetroTouch table-responsive">
                 <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#013694">
                  <tr>
                    <th height="34" bgcolor="#007EB6"><div align="left" class="style1 style10 style1">No</div></th>
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Cus Name</div></th>  
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Account</div></th>
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Beneficiary</div></th>
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Bank</div></th> 
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Swift</div></th>  
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Amount</div></th>  
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Date</div></th> 
                    <th bgcolor="#007EB6"><div align="left" class="style10 style1">Status</div></th>
                      <th bgcolor="#007EB6"><div align="left" class="style10 style1">Action</div></th> 
                 </tr>
                  <?php
				  $i=0;
				  $seLTransInfo = $conn->query("select * from transfer_info where acct_nmb = '" . $_GET['acct_nmb'] . "' ORDER BY date_trans DESC") or die($conn->error);
                  while($rowTInfo = $seLTransInfo->fetch_array()){
				  $i++;
				  ?>
                     
                     <?php
				 $selCusInfo = $conn->query("select * from customer_info  where acct_nmb = '" . $rowTInfo['acct_nmb'] . "'") or die($conn->error);
				 $rowCusInfo = $selCusInfo->fetch_assoc();
				 ?>  
				  <tr style="border-bottom:1px solid #666666;">
                  <td height="35" bgcolor="#FFFFFF"><div align="left"><?php echo $i; ?></div></td>
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowCusInfo['cust_name']; ?></div></td>  
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['acct_nmb']; ?></div></td>
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['ben_name']; ?></div></td> 
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['bank_name']; ?></div></td> 
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['swift_code']; ?></div></td>    
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['amt_trans']; ?></div></td> 
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowTInfo['date_trans']; ?></div></td>
                    <td bgcolor="#FFFFFF" ><div align="left" style="color: #2EE323;"><?php echo $rowTInfo['trans_stat']; ?></div></td>
                      
                      
                    <td bgcolor="#FFFFFF"><div align="left"><a href="view_user_attempt_transact.php?Tid=<?php echo $rowTInfo['trans_id']; ?>&action1=SELECT transaction&acct_nmb=<?php echo $rowTInfo['acct_nmb']; ?>">REMIND</a></div></td>
                      
                      
                   
                 
                </tr>
					<?php
					}
					?>	
                    </table>               
            </div>
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
