


    
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Panel | </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
   <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    
    
     <!-- login notification -->
  <script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
  <script src="bootstrap/js/jquery.min.js.download" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
      

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
              
              
            
            
            
            
            
            
            
            
        <li class="dropdown messages-menu" title="Dashboard Chat" >
            <a href="#" alt="Dashboard Chat" class="dropdown-toggle dropdown-toggle11" data-toggle="dropdown">
              <i class="glyphicon glyphicon-envelope"></i>
              <span class="label label-success count1"></span>            </a>
            <ul class="dropdown-menu">
              <li class="header"><span class="count1"></span> Unread chat messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu dropdown-menu11">
    
                </ul>
              </li>
              <li class="footer"><a href="chat.php">See All Messages</a></li>
            </ul>
          </li>

            <script>
$(document).ready(function(){
// updating the view with notifications using ajax
function load_unseen_messages(view_chat = '')
{
 $.ajax({
  url:"chat_fetch.php",
  method:"POST",
  data:{view_chat:view_chat},
  dataType:"json",
  success:function(data)
  {
   $('.dropdown-menu11').html(data.messages);
   if(data.unseen_messages > 0)
   {
    $('.count1').html(data.unseen_messages); 
   }
 if(data.unseen_messages > 0)
   {   
    $('.sound').html("<audio controls='controls' autostart='false' autoplay hidden=true  src='dist/sound/aaaaaa.mp3' preload='auto'></audio>");  
   }
  }
 });
}
load_unseen_messages();
// submit form and get new records
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != '')
 {
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#comment_form')[0].reset();
    load_unseen_messages();
   }
  });
 }
 else
 {
  alert("Both Fields are Required");
 }
});
// load new messages
$(document).on('click', '.dropdown-toggle11', function(){
 $('.count1').html('');
 load_unseen_messages('yes');
});
setInterval(function(){
 load_unseen_messages();;
}, 5000);
});
</script>
            
            
            
            
     
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
   
            
            
            
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
   
     <li class="dropdown" title="Login Activites">
          <a href="#" class="dropdown-toggle dropdown-toggleAA " data-toggle="dropdown" data-original-title="Login Activites"><span class="label label-pill label-danger count " style="border-radius:10px;"><span class="sound"></span></span> <span class="glyphicon glyphicon-bell sound" style="font-size:18px;"></span></a>
      <ul class="dropdown-menu dropdown-menuAA"></ul>
     </li>
   
 
        
     
            
            
            
            
            
            
            
            
             <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../things/upload/<?php echo $rowUser['cust_photo']; ?>" class="img-circle" alt="User Image">

                <p>
                  Administrator Panel | 
                  <small>&copy; <?php echo date("Y"); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Subscribers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Banking sector</a>
                  </div>
                  <div class="col-xs-4 text-center">
                      <i class="glyphicon glyphicon-envelope"></i>
                    <a href="https://webmail1.hostinger.com?_user=<?php echo $admin_email; ?>&_pass=😃😃😂😂😂😆😆" target="_blank">Webmail</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
 <a href="../LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>" class="btn btn-default btn-flat" onClick="Logoutfunction()"><i class="glyphicon glyphicon-off"></i> Sign out</a>
                    
                    <script type='text/javascript'>

    function Logoutfunction() {
var user_choice = window.confirm('Would you like to continue?  Continuing will log you of from your online banking');
if(user_choice==true) {
window.location='../LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>'; 
} else {
    
return false;
    
}
}
</script>
                </div>
              </li>
            </ul>
          </li>
            
            
            
        
            
            
            
            
            
            
            
            
            
            
            
            

   <ul class="nav navbar-nav">
         <li>
            <a href="#" data-toggle="control-sidebar"><i class="glyphicon glyphicon-cog"></i></a>
          </li>
    </ul>

            
            
            
            
            
            
            
            
            
            
            
<script>
$(document).ready(function(){
// updating the view with notifications using ajax
function load_unseen_notification(view = '')
{
 $.ajax({
  url:"fetch_login.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)
  {
   $('.dropdown-menuAA').html(data.notification);
   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification); 
   }
 if(data.unseen_notification > 0)
   {   
    $('.sound').html("<audio controls='controls' autostart='false' autoplay hidden=true  src='dist/sound/aaaaaa.mp3' preload='auto'></audio>");  
   }
  }
 });
}
load_unseen_notification();
// submit form and get new records
$('#comment_form').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != '')
 {
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#comment_form')[0].reset();
    load_unseen_notification();
   }
  });
 }
 else
 {
  alert("Both Fields are Required");
 }
});
// load new notifications
$(document).on('click', '.dropdown-toggleAA', function(){
 $('.count').html('');
 load_unseen_notification('yes');
});
setInterval(function(){
 load_unseen_notification();;
}, 5000);
});
</script>




            
            
        </ul>
      </div>
    </nav>
  </header>
    
