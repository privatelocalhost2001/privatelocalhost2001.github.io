<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/ipb.php');
if(isset($_GET['action'])){

$delCust = $conn->query("delete from customer_info where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
header("location:index.php?msg=User has been successfully deleted&id=". $_GET['id']);
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
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li s><a href="more_info_edit.php?&id=<?php echo $_GET['id']; ?>" >Edit Detail</a></li>
                
                
                
                  <!-- CUSTOMER INFO  -->
                 <?php
						 $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
						 ?> 
   
              <li class="pull-left header"><i class="fa fa-inbox"></i> Registered User <strong><?php echo $rowInfo['cust_name'] ?></strong></li>
            </ul>
            <div class="tab-content no-padding">
              <div style="margin:20px 0px 0px 10px;">   
                  
                  
              
                  
                  
                 <!-- CURRENCY  -->
                      <?php
						 $seLc = $conn->query("select * from curr_type where accnt_nmb = '" . $rowInfo['acct_nmb'] . "'") or die($conn->error);
                          $rowc = $seLc->fetch_array();
				
						 ?> 
                  
                  
                  
                 <!-- AMOUNT  --> 
                  <?php
     $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowInfo['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc();
    ?>
                  
                  
                   
                 <!-- PHOTOS  -->
                   <?php 
					 $d_img=  "<img src='../things/img/blank-profile-picture.pngimg/profile-pictures.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
					 $p_img=  "<img src='../things/upload/". $rowInfo['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					  ?>
            
                  
                
                 <form method="post" action="reg_user.php?lang=en" enctype="multipart/form-data">   
                                    <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                                    <table width="100%" height="396" align="center" cellpadding="5" cellspacing="3">
                                        
                                        
                                         
                                       
             <div class="prof-mg" >
             <?php echo $rowInfo['cust_photo'] =="" ? $d_img : $p_img; ?>
                     </div>
                                        
           <div class="col-xs-10 text-right">
              <strong style="color: red;"> Available Balance:</strong> <?php echo $rowc['curr_type']; ?>   <span style="color: black; bold"><?php echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?> </span>   
                </div>  
                                        
                  <tr>
                  <td><span class="style9">Customer full name</span></td>
                  <td><input type="text" name="cust_name" size="30" class="form-control" value="<?php echo $rowInfo['cust_name']; ?>" readonly="readonly"/></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Email ID</span></td>
                  <td><input type="email" name="email" size="30" class="form-control" value="<?php echo $rowInfo['email']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Phone Number</span></td>
                  <td><input type="tel" name="phn_nmb" size="30" class="form-control" value="<?php echo $rowInfo['phn_nmb']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Address</span></td>
                  <td><input type="text" name="addrs" size="30" class="form-control" value="<?php echo $rowInfo['addrs']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr> 
                  <td><span class="style9">Username</span></td>
                  <td><input type="text" name="username" size="30" class="form-control" value="<?php echo $rowInfo['username']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Password</span></td>
                  <td><input type="text" name="pass" size="30" class="form-control" value="<?php echo $rowInfo['pass']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Country</span></td>
<td>
                                      <select name="country" class="form-control">
                                    <option value=""><?php echo $rowInfo['country']; ?></option>
                                  
									</select>                  </td>
                  </tr>
                  <tr>
                  <td><span class="style9">Accout Number</span></td>
                  <td><input type="text" name="acct_nmb" size="30" class="form-control" value="<?php echo $rowInfo['acct_nmb']; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                  <td><span class="style9">Date of Birth</span></td>
                  <td>
     <?php $dayDob = explode('-', $rowInfo['day_birth']); ?>
	 
     <select name="day_birth" id="day_birth" style="width:100px; float:left" required class="form-control">
      <option value=""><?php echo $dayDob[2]; ?></option>
      </select>
      -
      <select name="mnth_birth" id="mnth_birth" style="width:100px; float:left" class="form-control">
      <option value=""><?php echo $dayDob[1]; ?></option>
      </select>
      -
      <select name="year_birth" id="year_birth" style="width:100px; float:left" class="form-control">
      <option value=""><?php echo $dayDob[0]; ?></option>
      </select>      </td>
                  </tr>
                  <tr>
                  <td><span class="style9">Zip code</span></td>
                  <td><input type="text" name="zip_code" size="30" class="form-control" value="<?php echo $rowInfo['zip_code']; ?>" readonly="readonly" /></td>
                  </tr> 
                                        
                     <tr>
                  <td><span class="style9">Last Login</span></td>
                  <td><input type="text" name="zip_code" size="30" class="form-control" value="<?php echo $rowInfo['last_log_time']; ?>" readonly="readonly" /></td>
                  </tr>                    
                                        
 
                                        
                                                           
            <td height="9" colspan="2">
            <button type="submit" id="offbutton" onclick="document.location='more_info_edit.php?&id=<?php echo $rowInfo['customer_id']; ?>'"   class="btn btn-warning-off" onclick="return changepassword()" class="btn btn-green col-lg-11">Edit Info</button>
           </td>
                                                    
                                        
                                   <div >  
     <td height="9" colspan="2">
    <button type="submit"  style="color:white; background-color: red;"  class="btn btn-warning-off"  onClick="delUserNotice()"  class="btn btn-green col-lg-11">Delete This User</button></td>
   </div>  
                    
<script type='text/javascript'>

    function delUserNotice() {
var user_choice = window.confirm('Would you like to continue?  Continuing will delete this user completely from your database');
if(user_choice==true) {
window.location='more_info.php?action=delte user&id=<?php echo $rowInfo['customer_id']; ?>'; 
} else {
    
return false;
    
}
}
</script>                                    
                                        
                                        
                                        
                                 
                  </table>
                          </form>               
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
                Advance Details
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;">
                
                
                
                
                 <h3> <strong>User Status</strong>      <span style="background-color: #f1f1f1; color: green; "><?php echo $rowInfo['suspend_status']; ?></span>
                  </h3> 
                <h3> <strong>OTP Status</strong>      <span style="background-color: #f1f1f1; color: green; "><?php echo $rowInfo['otp_status']; ?></span> 
                  </h3>
                   <h3> <strong>Trasaction Code</strong>      <span style="background-color: #f1f1f1; color: green; "><?php echo $rowInfo['cust_trans_stat']; ?></span> 
                  </h3>
                  
                  <P>.</P>
                  <P>
                  <button class="btn btn-warning-off"><div align="left" ><a href="view_transact_info.php?acct_nmb=<?php echo $rowInfo['acct_nmb']; ?>">View This Customer Transactions =></a></div></button>
                 </P>
                 
                
                
                
                
                </div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
            <div class="knob-label"><a href="credit_this_user.php?&acct_nmb=<?php echo $rowInfo['acct_nmb']; ?>">Credit This user</a></div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
             <div class="knob-label"><a href="sendemail_to_this_user.php?&id=<?php echo $rowInfo['customer_id']; ?>">Send Email Message</a></div>     
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label"><a href="more_info_edit.php?&id=<?php echo $rowInfo['customer_id']; ?>">Edit Info</a></div>
                </div>
                <!-- ./col -->
              </div>
                
             <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">.
                  <div id="sparkline-1"></div>
                  <div class="knob-label"><a href="customer_login.php?&acct_nmb=<?php echo $rowInfo['acct_nmb']; ?>" >Login Activites</a></div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">.
                  <div id="sparkline-2"></div>
                  <div class="knob-label" ><a  href="send_information.php?&id=<?php echo $rowInfo['customer_id']; ?>">Send Information</a></div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">.
                  <div id="sparkline-3"></div>
                  <div class="knob-label"><a href="notifications.php" >Edit Notifications</a></div>
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
