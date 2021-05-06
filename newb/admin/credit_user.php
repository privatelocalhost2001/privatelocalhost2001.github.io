<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/ipb.php');
if(isset($_POST['action'])){
    
    

 $whoto = $_POST['USER-ID'];  
    
 $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $whoto . "'") or die($conn->error);
 $rowInfo = $seLInfo->fetch_array();    
    

$selAcc = $conn->query("select * from customer_info where acct_nmb = '" . $rowInfo['acct_nmb'] . "'") or die($conn->error); 

if(!$selAcc->num_rows){
header("location:credit_user.php?msg=Sorry this account number does not exists please check and try again later");
}else{
if($_POST['trans_type']=="Credit"){
$amt_credit = $_POST['amt'];
$amt_debit = '0';
}else{
$amt_credit = '0';
$amt_debit = $_POST['amt'];
}
    

    
$cust_accnt =  $rowInfo['accnt_nmb']; 
    
$email = '';
$dob =  $_POST['year_birth'] ."-" . $_POST['mnth_birth'] . "-". $_POST['day_birth'];

$ins = $conn->query("insert into credit_info (transact_id, payee_name, payee_accnt, cust_name, accnt_nmb, trans_type, narratn, amt_cred, amt_dep, dat_pay, email) values (NULL, '" . $_POST['payee_name'] . "', '" . $_POST['payee_accnt'] . "', '" . $rowInfo['cust_name'] . "', '" . $rowInfo['acct_nmb'] . "', '" . $_POST['trans_type'] . "', '" . $_POST['narratn'] . "', '$amt_credit', '$amt_debit',  '$dob', '$email')") or 
    
 $sql = $conn->query("UPDATE credit_info
SET credit_info.email=(SELECT customer_info.email
  FROM customer_info
  WHERE customer_info.acct_nmb=credit_info.accnt_nmb)") or die($conn->error); 
    
                  

header("location:view_transact_info.php?msg=User '" . $rowInfo['cust_name'] . "' account has been  " . $_POST['trans_type'] . "ed  successfully&acct_nmb=" . $rowInfo['acct_nmb'] . "");
}
}

?>


<?php
 $sql = $conn->query("UPDATE credit_info
SET credit_info.email=(SELECT customer_info.email
  FROM customer_info
  WHERE customer_info.acct_nmb=credit_info.accnt_nmb)") or die($conn->error); 
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
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Registered Users</li>
            </ul>
            <div class="tab-content no-padding">
              <?php
			  if(isset($_GET['msg'])){
			  echo "<div class='alert alert-danger'>" . $_GET['msg'] . "</div>";
			  }
			  ?>
              <div style="margin:20px 0px 0px 10px;">     
                          <form method="post" action="credit_user.php" enctype="multipart/form-data">   
                                    
                                    <table width="100%" align="center" cellpadding="5" cellspacing="3">
                  <tr>
                  <td height="35"><span class="style9">Payee/Payer Name </span></td>
                  <td><input type="text" name="payee_name" class="form-control" size="30"  required/></td>
                  </tr>
                  <tr>
                  <td height="35"><span class="style9">Payee/Payer Account number</span></td>
                  <td><input type="text" name="payee_accnt" class="form-control" size="30"  required/></td>
                  </tr>
                                        
                       
                                        
                                        
                                        
                  <tr>                      
                  <td height="44"><span class="style9">Customer Name</span></td>
                  <td> <select name ="USER-ID" required class="form-control"  >  
                  <option value="">--- Select ---</option>  
                     
                        <?php
				  $i=0;
				  $seLInfo = $conn->query("select * from customer_info WHERE customer_id != 999") or die($conn->error);
                  while($rowInfo = $seLInfo->fetch_array()){
				  $i++;
				  ?>l_fetch_assoc($list)){  
                ?>  
                    <option value="<?php echo $rowInfo['customer_id']; ?>"<? if($rowInfo['customer_id']==$select){ echo "selected"; } ?>>
                                         <?php echo $rowInfo['cust_name']; ?>  
                    </option>  
               <?php
					}
					?> 
            </select>
            </td>
            </tr>                               
                  
                                        
                  
                                        
                 
                  <tr>
                  <td height="46"><span class="style9">Transaction type</span></td>
                  <td><select name="trans_type" class="form-control" style="color:#000099" required>
                      <option value="">--Select--</option>
                      <option value="Debit">Debit</option> 
                      <option value="Credit">Credit</option> 
                  </select>
                  </td>
                  </tr>
                   <tr>
                  <td height="91"><span class="style9">Narration</span></td>
                  <td><textarea name="narratn" id="narratn" size="10" class="form-control" cols="42" rows="5" required></textarea></td>
                  </tr>
    
                  <tr>
                  <td height="46"><span class="style9">Amount</span></td>
                  <td><input type="text" name="amt" size="10" class="form-control"  required /></td>
                  </tr> 
        		   <tr>
                  <td height="46"><span class="style9">Transaction Date</span></td>
                   <td td height="46">
     <select name="day_birth" id="day_birth" class="form-control" style="width:120px; float:left" required>
      <option value="">Day</option>
      <?php
	  for($i=1; $i<=31; $i++){
	  ?>
      <option value="<?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?>"><?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?></option>
      <?php
	  }
	  ?>
      </select>
      
      <select name="mnth_birth" id="mnth_birth" class="form-control" style="width:120px; float:left" required>
      <option value="">Month</option>
      <?php
	  for($i=1; $i<=12; $i++){
	  ?>
      <option value="<?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?>"><?php echo str_pad($i, '2', 0,  STR_PAD_LEFT); ?></option>
      <?php
	  }
	  ?>
      </select>
      <select name="year_birth" id="year_birth" class="form-control" style="width:120px; float:left" >
      <option value="">Year</option>
      <?php
	  for($i=date("Y"); $i>=1960; $i--){
	  ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php
	  }
	  ?>
      </select>      </td>
                  </tr>
    
                  <tr>
                  <td colspan="2">	<button  aria-label="Next" type="submit" name="action" value="register user">Credit Account</button></td>
                  </tr>
                 
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
