<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/ipb.php');




if (isset($_POST['sendEmail'])) {
    $whoto = $_POST['USER-ID'];
            $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $whoto . "'") or die($conn->error);
            $rowInfo = $seLInfo->fetch_array();

    $to = $rowInfo['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $from = $admin_email;

    $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$site_name.'... '. $from ."\r\n".
    $headers .= 'Reply-To: '.$admin_email.''. "\r\n";
'X-Mailer: PHP/' . phpversion();


    if (mail($to, $subject, $message, $headers)) {
        header('location:newsletter.php?msg=Customized Newslatters has been successfully sent to all customers');
    }
    else {
        echo "Sending failed";
    }
}







if(isset($_GET['blockthis'])){
//  OR   if($_SESSION['user_id']==''){  
    
$timeget = date('D d M Y,  h:i:sa');

     
    
    
    
    $seLBDI = $conn->query("select * from login_info where log_ip = '" . $_GET['lip'] . "'") or die($conn->error);
            $rowLBDI = $seLBDI->fetch_array();
          
          $ip = $rowLBDI['log_ip'];
          $htaccess = '../.htaccess';


// This pulls the current contents of your htaccess file so we can search it later.
$contents = file_get_contents($htaccess, TRUE) 
          OR exit('Unable to open .htaccess');

// Lets search the htaccess file to see if there is already a ban in place.
$exists = !stripos($contents, 'deny from ' . $ip . "\n") 
          OR exit('Already banned, nothing to do here.');



    // User is NOT in whitelist - we need to ban em...
       $ban =  "";
       $ban .= "Deny from {$ip}\n";

    file_put_contents($htaccess, $ban, FILE_APPEND) 
          OR exit('Cannot append rule to .htaccess');

    
    $mailler = '999999999';
// Send email if address is specified
    if (!empty($mailler)) {
        
        
        
        $headers = "From:'IP BAN.... $site_name'<alert@$domain>\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = "IP been ban successful $site_name ";
      
        
   $message = '<html><body>';
   $message .= '<div style="color: red; font-size:12px; font-weight:400"> ADMIN BAN THIS USER IP</div><br>';
   $message .= '<div style="color: black; font-size:12px; font-weight:400">'; 
   $message .= 'User Name: '. $rowLBDI['username'] .' <br>';
   $message .= 'Email: ' . $rowLBDI['email'] .' <br>';   
   $message .= 'IP Address: ' . $ip . '<br>';  
   $message .= 'Location: ' . $rowLBDI['location'] .' <br>';        
   $message .= 'Time: ' . $timeget . ' <br>';        
   $message .= '</div>';
   $message .= '</div>';
   $message .= '</body></html>';
    
        
      mail($admin_email,$subject,$message,$headers);
    }
    

header("Location: customers_login.php?msg=This ip has been ban");
exit;

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
     
                   <button  class="btn btn-warning-off" ><div align="right" class="pull-right" ><a href="customers_login.php">Back To All Login =></a></div></button>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
<div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
        
            
            
            
              <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-left box-tools">
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
               Customer Full login detail 
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;">
                
                
                <?php 
                  
                  $seLInfo = $conn->query("select * from login_info Where login_id = '" . $_GET['id'] . "' LIMIT 15") or die($conn->error);
                  $rowInfo = $seLInfo->fetch_array();
                  ?>
                  
                  
                  
                <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>   
                  
                  <table style="width:100%">
  <tr>
    <th>Customer</th>
    <th>Details</th>
    
 </tr>
                      
<tr>
<td>Firstname</td>
<td><?php echo $rowInfo['login_custn']; ?></td>
</tr>
                      
<tr>
 <td>Account</td>
  <td><?php echo $rowInfo['accnt_nmb']; ?></td>
 </tr>
                      
<tr>
 <td>Email</td>
 <td><?php echo $rowInfo['email']; ?></td>    
</tr>
  
<tr>
 <td>Username</td>
 <td><?php echo $rowInfo['username']; ?></td>    
</tr>    
                      
<tr>
 <td>Password</td>
 <td><?php echo $rowInfo['pass']; ?></td>    
</tr>
 
 <tr>
  <td>Login Time</td>
  <td><?php echo $rowInfo['login_time']; ?></td>
</tr>                     

                      
<tr>
 <td>Location</td>
 <td><?php echo $rowInfo['location']; ?></td>
</tr>
                      
<tr>
 <td>IP</td>
 <td><?php echo $rowInfo['log_ip']; ?></td>    
</tr> 
                      
                      
                  
                      
                      
      
                      
                      
                      
                      
                      <?php 
                      
                       $htaccess = '../.htaccess';
                       $ip = $rowInfo['log_ip'];
// This pulls the current contents of your htaccess file so we can search it later.
$contents = file_get_contents($htaccess, TRUE) 
          OR exit('Unable to open .htaccess');

// Lets search the htaccess file to see if there is already a ban in place.
           $check_am = strpos($contents, 'Deny from '.$ip.'');
                
             if ($check_am  == !false) { 
             echo'<div><td>STATUS</td><td style="color: red;"><strong>This IP IS ALREDY BAN</strong></td></div>';
             } 
            else
            {echo'<tr><td><button  class="btn btn-warning"  ><div align="right" class="pull-right" ><a href="customers_login_more.php?blockthis=block user&lip='.$rowInfo['log_ip'].'" style="color:red;"> Block This IP</a></div></button></td></tr>';}
          ?>

</table>
                
                

			
                
                
                
                
                
                
                
                
                
                
                
                
                
                </div>
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
    <strong>Copyright &copy; 2016-2017 <a href="https://adminlte.io"></a>.</strong> All rights
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
