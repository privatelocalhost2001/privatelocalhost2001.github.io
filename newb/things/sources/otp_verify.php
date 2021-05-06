<?php 
session_start();
include('conn_auth.php');
include('customInfo.php');
$errorMessage = '';
if(!empty($_POST["authenticate"]) && $_POST["otp"]!='') {
	$sqlQuery = "SELECT * FROM auth_otp WHERE otp='". $_POST["otp"]."' AND expired!=1 AND NOW() <= DATE_ADD(created, INTERVAL 1 HOUR)";
	$result = mysqli_query($conn, $sqlQuery);
	$count = mysqli_num_rows($result);
	if(!empty($count)) {
		$sqlUpdate = "UPDATE auth_otp SET expired = 1 WHERE otp = '" . $_POST["otp"] . "'";
		$result = mysqli_query($conn, $sqlUpdate);
        
        if($rowUser['suspend_status']=="Active"){
         header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../log-notification");
        }else{
            header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../user-suspended");
        }
		 
	} else {
		$errorMessage = "Invalid OTP!";
	}	
} else if(!empty($_POST["otp"])){
	$errorMessage = "Enter OTP!";	
}	
?>




<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Banking - <?php echo $rowUser['cust_name']; ?></title>
    <link href="things/css/bootstrap.css" rel="stylesheet" />
    <link href="things/css/font-awesome.css" rel="stylesheet" />
    <link href="custom.css" rel="stylesheet" />


     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
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
                  
                    
                </div>
             
            </div>
        </div>





    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 
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
    
    
    
    
    
    
    
    
    
    
    
    



<div class="container">	
	<div class="col-md-10">   
	<h2>Security OTP Verification </h2>	
	</div>
	<div class="col-md-8">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Enter OTP</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($errorMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
				<form id="authenticateform" class="form-horizontal" role="form" method="POST" action="">  					
					<div style="margin-bottom: 25px" class="input-group">
						<label class="text-success">Check your email for OTP</label>
						<input type="text" class="form-control" id="otp" name="otp" placeholder="One Time Password">                       
					</div>                          
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="authenticate" value="Submit" class="btn btn-success">						  
						</div>
					</div>                                
				</form>   
			</div>                     
		</div>  
	</div>
</div>	





  