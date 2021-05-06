<?php
session_start();
include('../sources/config.php');
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>



<html>
<head>
<title>Forget Password</title>
<link href="things/img/favicon/favicon.png" rel="icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
   

       <link href="things/css/custom.css" rel="stylesheet" />
     <link href="things/css/bootstrap.css" rel="stylesheet" />

    <link href="things/css/font-awesome.css" rel="stylesheet" />
    <link href="things/axd/axd/WebResource.axd" type="text/css" rel="stylesheet" class="Telerik_stylesheet">
    
    </head>
<body>
    
    
    
    
       <div class="contain-to-grid">
              <div id="google_translate_element" class="right"></div>
            <div style="padding-left: 50px">
            </div>
        </div>
     <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    
  
    
<div class="container">
 <div class="imgcontainer"  >
    <a href="<?php echo $site_url ; ?>"><img src="things/img/logo.png" alt="logo" class="logo"></a>
  </div>
    
    
    
   
    
    
    
    
    <div class="regisFrm">
        <h2>Enter the Email of Your Account to Reset New Password</h2>
        <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
        <form action="recov-engin" method="post">
            <input type="text" name="username" placeholder="LOGIN USERNAME">
            <input type="email" name="email" placeholder="EMAIL">
            <div class="send-button">
                <input type="submit" name="forgotSubmit" value="CONTINUE">
                 
               </div> 
                <div class="button">
                <input type="button" onclick="window.location.href = './';" value="EXIT"/>
            </div>
            
        </form>
    </div>
    </div>
    
    
    
    
    
    
    
    </body>
 
       
       
       
       
       
       
     
       
       
       
       
<div class="footer" >
     <div class="row" >
     <div class="col-lg-12" >
    <div class="page-footer-inner" > <?php echo date("Y"); ?> © Internet Banking.
    <a href="<?php echo "$site_url";?>" title="" target="_blank"><span><?php  echo "$site_name";?></span></a>
     </div>
     </div>
     </div>
    </div>


       

</html> 