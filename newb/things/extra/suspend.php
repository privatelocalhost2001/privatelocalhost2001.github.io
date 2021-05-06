<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/config.php');
include('../sources/customInfo.php');

?>
  <!-- /. NAV TOP  -->
        <!-- . SIDENAV  -->
    <!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Banking - <?php echo $rowUser['cust_name']; ?></title>
      <!-- Favicons -->
 <link href="things/img/favicon/favicon.png" rel="apple-touch-icon">
 <link href="things/img/favicon/favicon.png" rel="icon">
	<!-- BOOTSTRAP STYLES-->
    <link href="things/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="things/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="things/css/custom.css" rel="stylesheet" />
    <link href="./things/css/custom.css" rel="stylesheet" />
    <link href="things/axd/axd/WebResource.axd" type="text/css" rel="stylesheet" class="Telerik_stylesheet">
                    <!--TRANSFER PROCESS-->
<script type="javascript" src="things/js/bank/jquery.1.8.3.min.js"></script> 
<script type="javascript" src="things/js/bank/script.js"></script>
<script src="things/js/jquery.min.js.download" type="text/javascript"></script>
    
      
    <script type="text/javascript">
  $(document).ready(function () {

            var greetings = "Good Day";
            var dt = new Date();
            //greetings
            var hours = dt.getHours();

            if (hours < 12) {
                greetings = "Good Morning";
            }
            else if (hours >= 12 && hours < 17) {
                greetings = "Good Afternoon";
            }
            else {
                greetings = "Good Evening";
            }

            $('.greetings').text(greetings);
            $('.displayGreetings').removeClass('hide');

            //var urlpathArray = $(location).attr('pathname').split('/');


            //var filename = urlpathArray[urlpathArray.length - 1].replace('.aspx', '').toLowerCase();

            //if (filename == "accountactivity")
            //    filename = "accountsummary";

            //if ($('.' + filename) !== undefined) {

                
            //    $('.' + filename).parent().parents("li").find(".arrow ").after("<span class='selected'></span>");
            //    $('.' + filename).find(".arrow ").after("<span class='selected'></span>");

            //    $('.' + filename).parent().parents("li").find(".arrow ").attr("class", "arrow open");
            //    $('.' + filename).find(".arrow ").attr("class", "arrow open");
            //    $('.' + filename).parent().parents("li").attr("class", " nav-item  active open");
            //    $('.' + filename).attr("class", filename + " nav-item  active open");
               
               
              
            //}
            var isMobile = {
                Android: function () {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function () {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                ios: function () {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function () {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                ieMobile: function () {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                Any: function () {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.ieMobile() || isMobile.Opera() || isMobile.ios());
                }

            }
            if (!isMobile.Any()) {
                $('#feedbacklocation').feedBackBox();
            }

            $(function() {
                var tooltips = $( "[title]" ).tooltip({
                    position: {
                        my: "center top",
                        at: "center top",
                        of: window
                    }
                });
            });
            $('.ui-helper-hidden-accessible').remove();
           
        });
   
    </script> 
    
    
    <script type="text/javascript">
var closing = true;
$(function () {
    $("a,input[type=submit]").click(function () { closing = false; });
    $(window).unload(function () {
        if (closing) {
            var r = window.confirm("Are you sure you want to log off from this website");
            if (r = true) {
                jQuery.ajax({ url: ".../App/Security/logout", async: false });
            }
        }
    });
});
</script>
    
    
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body onload="myBodyFunction()">
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                
                
                
                
                  <div class="pull-right count_img">
<!-- Code provided by Google -->
<div id="google_translate_element"></div>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', autoDisplay: false}, 'google_translate_element'); //remove the layout
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>


<script type="text/javascript">
    function triggerHtmlEvent(element, eventName) {
var event;
if(document.createEvent) {
    event = document.createEvent('HTMLEvents');
    event.initEvent(eventName, true, true);
    element.dispatchEvent(event);
} else {
    event = document.createEventObject();
    event.eventType = eventName;
    element.fireEvent('on' + event.eventType, event);
}
}
            <!-- Flag click handler -->
        $('.translation-links a').click(function(e) {
  e.preventDefault();
  var lang = $(this).data('lang');
  $('#google_translate_element select option').each(function(){
    if($(this).text().indexOf(lang) > -1) {
        $(this).parent().val($(this).val());
        var container = document.getElementById('google_translate_element');
        var select = container.getElementsByTagName('select')[0];
        triggerHtmlEvent(select, 'change');
    }
});
});

        </script>
          </div>
       
                
                
                
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                     <a class="navbar-brand" href="">
                        <img src="things/img/portal_logo.png" />
                    </a>
                    
                </div>
                
                 
                
        
              
                <span class="logout-spn" >
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                  <a href="LOG-IN-OUT?action=Logout" style="color:#fff;">LOGOUT</a>  
                </span>
                
     
             
            </div>
        </div>
    <?php include('../includes/sidebar.php');?>
  


        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    
                    
                    
                    
                    
                    
                       <li class="dashboard">
                          <a href="" class="nav-link nav-toggle">
                                <i class="fa fa-th"></i>
                                <span class="title">Dashboard</span>
                                <span class="arrow"></span>
                            </a>
                           
                        </li>
                         
                         
                         
                         <div class="dropdown">
                                                <a  class="nav-link nav-toggle">
                              <i class="fa fa-bar-chart-o" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Account</span>
                                <span class="arrow"></span>
                            </a>
                            </div>
                         
                                                  
                
                             
            <div class="dropdown">
                         <li class="nav-item">
                            <a class="nav-link nav-toggle">
                                <i class="fa fa-credit-card" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Card</span>
                                <span class="arrow"></span>
                            </a>
                             </div>
                              
              
                   

                    <div class="dropdown">
                        <li class="nav-item">
                              <a  class="nav-link nav-toggle">
                                <i class="fa fa-exchange" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Transfer</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                            </div>
                    
                       
                     

                            
                            
                            
                            <div class="dropdown">
                        <li class="nav-item  ">
                            <a  class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-list-alt"style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Payment</span>
                                <span class="arrow"></span>
                            </a>
                             </li>
                            </div>
                
                     
              
              
                       
                          <li class="airtime">
                            <a  class="nav-link">
                                 <i class="glyphicon glyphicon-phone"></i>
                                <span class="title">Airtime Topup</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>

			 <li class="databundle">
                            <a  class="nav-link">
                                <i class="glyphicon glyphicon-phone"></i>
                                <span class="title">Data Bundle Topup</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>	
						
			<li class="travelbooking">
                            <a  class="nav-link nav-toggle" target="_blank">
                                 <i class="fa fa-plane" aria-hidden="true"></i>
                                <span class="title">Book Travel Ticket</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>                     
                        
                                
                                
                    <div class="dropdown">            
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-briefcase" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Help & Assistance </span>
                                <span class="arrow"></span>
                            </a>
                            </div>
              
                            <div class="dropdown-container">                                                        
                                <li class="chequerequest">
                                    <a href="tel:<?php include 'config.php'; echo "$admin_phone";?>" class="nav-link">
                                        <span class="title">Call Customer Care</span>
                                    </a>
                                </li>

                                <li class="chequeconfirmation">
                                    <a href="mailto:<?php include 'config.php'; echo "$admin_email";?>" class="nav-link">
                                        <span class="title">Email Us</span>
                                    </a>
                                </li>                              
                              
                         

                                 <li class="updatebvn">
                                    <a  class="nav-link">
                                        <span class="title">BVN Update</span>
                                    </a>
                                </li>

                              </div>
                        </li>

                        
                        
                        <div class="dropdown">
                            <li class="nav-item  ">
                        <li class="nav-item  ">
                            <a  class="nav-link nav-toggle">
                                <i class="fa fa-cog"style="color:#214761;"></i>
                                <span class="title" style="padding:12px; color:#214761;">Settings</span>
                                <span class="arrow"></span>
                            </a>
                          </div>

                          
                                
                                                 


                         <li class="nav-item  ">
                            <a  >
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <span class="title">Feedback</span>
                                <span class="arrow"></span>
                            </a>
                           </li>
                         <li class="nav-item  ">
                            <a href="login.php?action=Logout" class="nav-link">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span class="title">Logout</span>
                                <span class="arrow"></span>
                            </a>
                           </li>
                 


                       <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>      
                </ul>
                            </div>

        </nav>
    
      <?php
                 
                 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
                 $rowTrans = $selTrans->fetch_assoc();
                 ?> 
    
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                      <marquee behavior="scroll" direction="left" >
                            <h3 style="color:purple" class="page-title"> <span id="displayGreetings" class="displayGreetings"><span id="greetings" class="greetings"></span>,  <?php echo $rowUser['cust_name']; ?>  Welcome to your safe online banking ...At <?php include 'config.php'; echo "$site_name";?> we offer you the best.</span>  
                       </h3></marquee>  
                    </div>
                </div>              
                 <!-- /. ROW  -->
               
         
                                                                  
     <?php
     $selBank = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $rowUser['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
     $rowBank = $selBank->fetch_assoc();
    ?>
                
                
      
           <div class="alert alert-danger">   
               
                 <?php 
                     $d_img=  "<img src='img/profile-pictures.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
                     $p_img=  "<img src='things/upload/". $rowUser['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
                      
              ?>
       
            
             <?php echo $rowUser['cust_photo'] =="" ? $d_img : $p_img; ?>
                
                
        <div class="col-md-6"   style="font-weight: 900;font-size: 16px; color: BLACK;"> 
  <?php echo $rowBank['accnt_nmb']; ?>------<?php echo getCurrency($rowcurr['curr_type']);  echo number_format($rowBank['totalCredit']-$rowBank['totalDebit'], 2, '.', ','); ?>-----<?php echo $rowUser['cust_name']; ?>
                        </div>
     
        
        
        <h5 style="color:red"  class="pull-right">Current Time:  <span style="color: BLACK;"><?php 

echo date(" h:i a M,d,Y") . "\n"; 

?>  </span></h5>
          </div>
              
          
            
            
                     
                     
                     
                         <div class="row">
         
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="div-square" style=" background-color: green; red;color:white;">
                                            <div class="visual">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="details">
                                                <h3><div class="number" id=""><span class="counter" data-counter="counterup" >Non Available</span></div></h3>
                                                <div class="desc"> Total Deposits </div>
                                            </div>
                                        </div>
                                    </div>
                    
                    
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                         <div class="div-square" style=" background-color: #ff3333;color:white;">
                                            <div class="visual">
                                                 <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="details">
                                                <h3><div class="number" id="">Non Available</div></h3>
                                                <div class="desc"> Total Withdrawal </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                    
                             
                                   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="div-square">
                                       <div class="dashboard-stat white managerDetail"><div class="manager"><h4>Account Manager Details</h4><div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" photo="" image62=""><img src="things/img/RsmInforPicture" style="width:62px; height:55px; margin-left:13px;"></div><div class="col-lg-8" col-md-8="" col-sm-4="" col-xs-4=""><div class="row"> <div class="col-md-12 mleft10"><span class="email"><a href="mailto:<?php include 'config.php'; echo "$admin_email";?>"  style="color:blue;"><?php include 'config.php'; echo "$admin_email";?></a></span><br><span class="phone"><a href="tel:<?php include 'config.php'; echo "$admin_phone";?>" style="color:blue;"><?php include 'config.php'; echo "$admin_phone";?></a></span><span class="branch"></span></div> </div></div></div>   </div> <span class="more" style="font-weight: 900;"><?php include 'config.php'; echo "$site_name";?></span></div>
                                    </div>
                                </div>
                                      
                                </div>
                  
                
                
                    
               
                 
                     <div style="padding:9px;font-weight: 900;">
                            <br>
</div>    
         
                                <div class="panel-heading">
                <h3 class="panel-title" style="font-weight: 900;">Mini Statement</h3>
            </div>   
                           
                           
                           
                     
                     
                  <div id="grid-block" class="" style="">

                    <div id="ctl00_MainContent_ministatement" class="RadGrid RadGrid_MetroTouch table-responsive" style="width:100%;" tabindex="0">


            
                      <div style="color: red;font-size:29px; font-family:Helvetica; padding;9px; margin:15px 0px 15px 0px;">Your account have been suspended due to failure of activating your account on the Stipulated time ,<br>For assistance on how to reactivate your account contact<br>
<a href="mailto:<?php include 'config.php'; echo "$admin_email";?>">Customer Care</a></div> 




    
                  </div>
              </div>
           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- . FOOTER  -->
 
 <?php include('../includes/footer.php');?>
        <!-- /. FOOTER  -->
          
