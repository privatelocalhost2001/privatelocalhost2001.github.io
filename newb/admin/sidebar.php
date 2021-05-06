
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../things/upload/<?php echo $rowUser['cust_photo']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $rowUser['cust_name']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a><br>
        <a href="#"><small><i>Last login: <?php echo $rowUser['last_log_time']; ?>
       </i></small></a>    
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
        <li ><a href="../LOG-IN-OUT?action=Logout" onClick="Logoutfunction()"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-user"></i>
            <span>Customer Information</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">7</span>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="reg_user.php"><i class="glyphicon glyphicon-plus"></i>Register Customer</a></li>
            <li><a href="view_users.php"><i class="glyphicon glyphicon-user"></i>View User</a></li>
              <li><a href="customers_login.php"><i class="glyphicon glyphicon-eye-open"></i>View Login Activites</a></li>
             <li><a href="currency.php"><i class="glyphicon glyphicon-usd"></i>Change Users Currency</a></li>
              <li><a href="otp_control.php"><i class="glyphicon glyphicon-wrench"></i>OTP control</a></li>
              <li><a href="suspend_user.php"><i class="glyphicon glyphicon-ban-circle"></i>Suspend User</a></li>
               <li><a href="delete_users.php"><i class="glyphicon glyphicon-trash"></i>Delete User</a></li>
          
          
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-transfer"></i> <span>Transactions</span>
            <span class="pull-right-container">
             <span class="label label-primary pull-right">5</span>            </span>          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="credit_user"><i class="fa fa-circle-o"></i> Credit Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right">2</i>                </span>              </a>
              <ul class="treeview-menu">
                <li><a href="credit_user.php"><i class="fa fa-circle-o"></i> Credit User</a></li>
                 <li><a href=" view_all_transact.php"><i class="fa fa-circle-o"></i> View Customer Balance </a></li>
              
                </ul>
            </li>
              <li><a href="code_control.php"><i class="glyphicon glyphicon-stop"></i>Stop Transfer Codes</a></li>
              <li><a href="view_users_trans.php"><i class="glyphicon glyphicon-transfer"></i> View Users Transactions</a></li>
              <li><a href="view_edit_trans.php"><i class="glyphicon glyphicon-edit"></i> Edit Users Transactions</a></li>
              <li><a href="view_attempt_transact.php"><i class="glyphicon glyphicon-eye-open"></i> View Attempt Transactions</a></li>
              
            </ul>
        </li>
          
          
          
          <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-tasks"></i>
            <span>Billing Stages</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="create_stage.php"><i class="glyphicon glyphicon-wrench"></i>Create/Edit Billing stage</a></li>
            <li><a href="create_code.php"><i class="glyphicon glyphicon-wrench"></i> Create/Edit Codes</a></li>
     
          </ul>
        </li>
          
          
          
          
          
           <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-comment"></i>
            <span>Communications</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">3</span>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="sendemail.php"><i class="glyphicon glyphicon-send"></i>Send Customer Email</a></li>
            <li><a href="newsletter.php"><i class="glyphicon glyphicon-envelope"></i>Newsletters Email</a></li>  
            <li><a href="chat.php"><i class="	glyphicon glyphicon-comment"></i>Chats</a></li>
     
          </ul>
        </li>
          
          
          <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-cog"></i>
            <span>Other Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>            </span>          </a>
          <ul class="treeview-menu">
            <li><a href="notifications.php"><i class="glyphicon glyphicon-stop"></i>Stop Notifications</a></li>
            <li><a href="code_control.php"><i class="glyphicon glyphicon-stop"></i>Stop Transfer Codes</a></li>  
           
     
          </ul>
        </li>
          
    
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
