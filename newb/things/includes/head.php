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
    <script src="things/js/bootstrap.min.js" type="text/javascript"></script>
    
      
    
    
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
                     <a class="navbar-brand" href="portal">
                        <img src="things/img/portal_logo.png" />
                    </a>
                    
                </div>
                
     <style type="text/css">
    .flat
    {
      width: 150px;
      padding: 10px;
      background-color: #FF8C00;
      box-shadow: -8px 8px 10px 3px rgba(0,0,0,0.2);
      font-weight:bold;
      text-decoration:none;
    }
    #cover{
      position:fixed;
      top:0;
      left:0;
      background:rgba(0,0,0,0.6);
      z-index:5;
      width:100%;
      height:100%;
      display:none;
    }
    #loginScreen
    {
      height:380px;
      width:340px;
      margin:0 auto;
      position:relative;
      z-index:10;
      display:none;
      background: url(login.png) no-repeat;
      border:5px solid #cccccc;
      border-radius:10px;
    }
    #loginScreen:target, #loginScreen:target + #cover{
      display:block;
      opacity:2;
    }
    .cancel
    {
      display:block;
      position:absolute;
      top:3px;
      right:2px;
      background:rgb(245,245,245);
      color:black;
      height:30px;
      width:35px;
      font-size:30px;
      text-decoration:none;
      text-align:center;
      font-weight:bold;
    }
  </style>
                
       
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
               <!--        <script src="things/js/bootstrap.min.js"></script>          --> 
                
    <script src="things/js/jquery.min.js.download" type="text/javascript"></script>
                
                
    <?php            
    $selBB = $conn->query("SELECT * FROM send_info WHERE accnt_nmb = '" . $rowUser['acct_nmb'] . "' ") or die($conn->error);
if($selBB->num_rows){             
                
      echo
        '<ul class="nav navbar-nav navbar-right">
     <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="fa fa-envelope-o" style="font-size:18px;"></span></a>
      <ul class="dropdown-menu"></ul>
     </li>
    </ul>' ;        
} 
else
{ 
    echo 'No Information';
}
                
   ?>
                           
                <script>
            
$(document).ready(function(){
// updating the view with notifications using ajax
function load_unseen_notification(view = '')
{
 $.ajax({
  url:"things/sources/msg_fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)
  {
   $('.dropdown-menu').html(data.notification);
   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
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
   url:"things/sources/insert.php",
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
$(document).on('click', '.dropdown-toggle', function(){
 $('.count').html('');
 load_unseen_notification('yes');
});
setInterval(function(){
 load_unseen_notification();;
}, 5000);
});
</script>         
  
         
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                           
        
                
        
              
                <span class="logout-spn" >
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                  <a href="LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>" onClick="Logoutfunction()" style="color:#fff;">LOGOUT</a>  
                </span>
                
     
             
            </div>
        </div>
        
        