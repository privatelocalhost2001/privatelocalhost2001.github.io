<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/ipb.php');

if(isset($_GET['action'])  && $_GET['action']=="delete code"){

$insDel = $conn->query("delete from bill_code where code_stage_id = '" . $_GET['code_id'] . "'") or die($conn->error);
header("location:view_code_bill.php?msg=Code have been deleted successfully&stage_id=". $_GET['stage_id']);
}

?>
<?php include 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row['fullname']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li ><a href="../login.php?action=Logout">Logout</a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Customer Information</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="reg_user.php"><i class="fa fa-circle-o"></i>  Register Customer</a></li>
            <li><a href="view_users.php"><i class="fa fa-circle-o"></i> View Users</a></li>
            <li><a href="enter_code.php"><i class="fa fa-circle-o"></i> Internation Code</a></li>
            <li><a href="view_code.php"><i class="fa fa-circle-o"></i> View Code
            </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="edit_transactions.php"><i class="fa fa-circle-o"></i>Stop transaction</a></li>
            <li class="treeview">
              <a href="credit_user"><i class="fa fa-circle-o"></i> Credit Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>                </span>              </a>
              <ul class="treeview-menu">
                <li><a href="credit_user.php"><i class="fa fa-circle-o"></i> Credit User</a></li>
                 <li><a href=" view_all_transact.php"><i class="fa fa-circle-o"></i> View Customer Balance </a></li>
              
                </ul>
            </li>
            </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Billing Stages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>            </span>          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#stage"><i class="fa fa-circle-o"></i> Stages 
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>                </span>              </a>
              <ul class="treeview-menu">
                <li><a href="create_stage.php"><i class="fa fa-circle-o"></i> Create/Edit Billing stage</a></li>
                 <li><a href="create_code.php"><i class="fa fa-circle-o"></i> Create/Edit Codes  </a></li>
                </ul>
            </li>
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

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
              <li class="pull-left header"><i class="fa fa-inbox"></i> Create Codes</li>
            </ul>
            <div class="tab-content no-padding">
              <?php
			  if(isset($_GET['msg'])){
			  echo "<div class='alert alert-danger'>" . $_GET['msg'] . "</div>";
			  }
			   $seLBill = $conn->query("select * from bill_stage where stage_name = '" . $_GET['stage_id'] . "'") or die($conn->error);
			   $rowB = $seLBill->fetch_assoc();
			  ?>
              
              <div style="margin:20px 0px 0px 10px;">     
                         <div class="col-lg-12" style="background:#FFFFFF; padding:9px;">
                  <?php
				  $i=0;
				  $seLInfo = $conn->query("select * from bill_stage where stage_name = '" . $_GET['stage_id'] . "'") or die($conn->error);
                  $rowInfo = $seLInfo->fetch_array();
				  $selCodes = $conn->query("select * from bill_code where stage_name = '" . $_GET['stage_id'] . "'") or die($conn->error);
				  ?>
				  <div class="col-lg-4 stage-div">
                  <h2><?php echo $rowInfo['stage_name']; ?></h2>
                  Name: <?php echo $rowInfo['stage_n']; ?><br>
                  Date: <?php echo $rowInfo['date_cr']; ?><br>
                  <div class="dropdown">
                  <span><h3 style="background:#28598E; color:#fff; font-size:1.2em; padding:4px;"> Codes </h3></span>
                  <?php 
                  if(!$selCodes->num_rows){
				  echo "<span class='pull-left'>No code has been entered for this stage</span>";
				  }else{
				  while($rowCode = $selCodes->fetch_array()){ 
				  ?>
				<div style="display:block;">
                  <div class="pull-left"><?php echo $rowCode['code_n']; ?></div>
                  <div class="pull-right"><a href="view_code_bill.php?action=delete code&code_id=<?php echo $rowCode['code_stage_id']; ?>&stage_id=<?php echo $rowInfo['stage_name']; ?>">Delete</a></div>
	            <hr>
                </div>
                  <?php
				  }
				  }
                  ?>
                  </div>
                 
                  
                  </div>
				    </div>     
                                       </div>    
                                     <hr>

                        
          
              
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
              
              </div>
            
            
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
