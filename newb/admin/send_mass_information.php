
<?php 
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/config.php');
require('../things/sources/ipb.php');





if(isset($_POST['SendThisUserNote'])){
    

 
$create_t =  $conn->query("create table if not exists send_info (
                             info_id int(11) NOT NULL auto_increment,
                             info_status int(1) NOT NULL,
							 accnt_nmb varchar(90) NOT NULL default '',
                             info_sbj varchar(90) NOT NULL default '',
							 info_msg varchar(2000) NOT NULL default '',
                             info_date varchar(60) NOT NULL default '',
							 PRIMARY KEY(info_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);

 
$create = $conn->query("insert into send_info (info_id, info_status, accnt_nmb, info_sbj, info_msg, info_date) values (NULL, '1', 'ALL', '" . $_POST['info_sbj'] . "', '" . $_POST['info_msg'] . "', '" . date("d M Y, g:i a") . "')") or die($conn->error);
    
header('location:send_mass_information.php?msg=Mass Notification Sent successfully for ');    
}




if(isset($_GET['DELNINF'])){
$delT = $conn->query("delete from send_info where info_id = '" . $_GET['INID'] . "'") or die($conn->error);
header("location:send_mass_information.php?msg=Mass Notification information  has been successfully removed&id=". $_GET['iddd']);
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
                

             
                
                <button  class="btn btn-warning-off" ><div align="right" class="pull-right" ><a href="index.php">Back To Main </a></div></button>
                
              <li class="pull-left header"><i class="fa fa-inbox"></i>Mass Notification Dashboard<strong></strong> </li>
            </ul>
      
              
              
              
              
              
              
   
            <div class="tab-content no-padding">
              <div style="margin:20px 0px 0px 10px;">                              
                 
        <form id="form1" name="form1" method="post" action="send_mass_information.php">  
            
            <div>
               <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                </div>
            
 

              
            
                 <tr>
                  <td height="52"><span class="style9">Subject</span></td>
                  <td><input name="info_sbj" type="text" value=""  size="30" class="form-control"  title="Add a message subject" /></td>
                  </tr>
            
    
            
             <div>
        <textarea name="info_msg" class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                 <input type="reset" value="Clear">
                
    <button  class="pull-right btn btn-default" type="submit"   name="SendThisUserNote" value="sendEmail" >Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>  
            
            
            
       
        </form>  
                  
                  
                  
                  
                  
                  
                  
               
                  
                  <h1>Current Notifications</h1>
                  
                  
                        <table width="100%" align="center" cellpadding="3" cellspacing="1" bgcolor="#013694">
                  <tr>
                  <th height="34" bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    
                      No
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    SUbject
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Message
                  </div></th>
                  <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Date                 
                     </div></th>
                      <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                    Action                 
                     </div></th>
                     <th bgcolor="#007EB6"><div align="left" class="style2 style1 style12">
                   &nbsp;                 
                     </div></th>
                   </tr>
                  <?php
				  $i=0;
				  $seLNInfo = $conn->query("select * from send_info where accnt_nmb = 'ALL'") or die($conn->error);
                  if(!$seLNInfo->num_rows){
				  ?>
                  <tr>
                  <td height="37" colspan="8" bgcolor="#FFFFFF">This customer notification information. </td>
                  </tr>
                  <?php
				  }else{
                  
				  while($rowNInfo = $seLNInfo->fetch_array()){
				  $i++;
				  ?>
				  <tr style="border-bottom:1px solid #666666;">
                  <td height="29" bgcolor="#FFFFFF"><div align="left"><?php echo $i; ?></div></td>
                  <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowNInfo['info_sbj']; ?></div></td>
                   <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowNInfo['info_msg']; ?></div></td>
                    <td bgcolor="#FFFFFF"><div align="left"><?php echo $rowNInfo['info_date']; ?></div></td>  
                 <td bgcolor="#FFFFFF"><div align="left"><a href="send_information.php?INID=<?php echo $rowNInfo['info_id']; ?>&DELNINF=Delete information&iddd=<?php echo $rowp['customer_id']; ?>" onclick="clickedTrans(event)" >Delete</a></div></td>
                      
                
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
    if(!confirm('This will Delete  this Notification Information for this user')) {
        e.preventDefault();
    }
}
</script>
                  
                  
                  
                  
                  
                
                                  
                                        
                
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
          
            <!-- /.box-body-->
       
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
