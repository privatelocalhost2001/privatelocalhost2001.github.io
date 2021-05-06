<?php
session_start();
include('conn_auth.php');
include('customInfo.php');
include('config.php');



if($rowUser['access_lvl']==3){
    
// replace admin old login time
$ins = $conn->query("update customer_info set
	last_log_time = '" . $rowUser['current_log_time'] . "'  WHERE username =  '" . $rowUser['username'] . "' ") or die($conn->error);

// admin last login date   
$ins = $conn->query("update customer_info set
	current_log_time = '" . date("D M d, Y g:i a") . "'  WHERE username =  '" . $rowUser['username'] . "' ") or die($conn->error);
    
// admin chat   online status
$ins = $conn->query("update customer_info set online = 1  WHERE customer_id =  '" . $rowUser['customer_id'] . "' ") or die($conn->error);    
    
header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../admin");
}else{

if($rowUser['otp_status']=="On"){
          $email =  $rowUser['email'];
		$otp = rand(100000, 999999);
   // Create email headers   
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: login@$domain \r\n";
        'X-Mailer: PHP/' . phpversion();
    
    $subject = "OTP to Login From $site_name ";
    
		$messageBody = '<div style="padding: 9px;">
<table style="height: 1258px; background-color: #e4f2ec; width: 569.5px;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 357px;">
<td style="height: 357px; width: 449.5px;" valign="top" bgcolor="#FEFEFE">
<table border="0" width="450" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td bgcolor="#FFFFFF"><img src="'.$site_url.'/things/img/Onboarding.png" width="540" height="338" border="0" /></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 545px;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 250px;">
<td style="width: 541px; height: 250px;" valign="top">
<p><span style="font-size: 12pt;"><strong>Hello '. $rowUser['cust_name'] . ',</strong></span></p>
<p>&nbsp;</p>
<p><span style="font-size: 12pt;"><strong>One Time Password for login authentication is:&nbsp; &nbsp;'. $otp .'</strong></span></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><span style="color: #808080;">Thank you for choosing '.$site_name.'.</span></p>
<br />
<p><span style="color: #999999;"><em>Please note that '.$site_name.' will</em>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span><span style="color: #999999;">for</span>&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 55px;">
<td style="height: 55px; width: 449.5px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="550" height="43" /></p>
</td>
</tr>
<tr style="height: 93px;">
<td style="height: 93px; width: 449.5px;" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 99px;">
<td style="height: 99px;" valign="top" width="31%">&nbsp;</td>
<td style="height: 99px;" valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td style="height: 99px;" valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></td>
<td style="height: 99px;" valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 70px;">
<td style="height: 70px; width: 449.5px;" valign="top">
<table style="width: 575.5px;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 119px;">
<td style="width: 571.5px; height: 119px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on '.$admin_phone.'</span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';
		
        
		$mailStatus = mail($email, $subject, $messageBody, $headers);		
		if($mailStatus == 1) {
			$insertQuery = "INSERT INTO auth_otp(otp,	expired, created) VALUES ('".$otp."', 0, '".date("Y-m-d H:i:s")."')";
			$result = mysqli_query($conn, $insertQuery);
			$insertID = mysqli_insert_id($conn);
			
             header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../OTP-Verification");    
			
			}else{
            echo '<div border="0" width="574" cellspacing="0" cellpadding="0" align="center" >
            <div class="popup-inner-small">

                <div >
                    <hr>
                    <div style="margin-left: 60px; line-height: 17px; height: 30px;">
                        <b id="session-notification"></b>
                        </div>
                        <hr>
                    <div id="session-not">
                    <span style="background-color: blue;   color:#FFFFFF; padding: 5px; text-align: center; width: 100%;">you can not login now please try again letter...</span>
        <p>If the continues please contact customer care on <a id="" href="mailto:'.$admin_email.'"><i class="fa fa-sign-out">  '.$admin_email.'</a> </p>
                  <a id="" href="home"><i class="fa fa-sign-out"></i>&nbsp;Click here</a>
                 to Re-Login
                    </div>
                </div>
            </div>
        </div>';
        }
		}else{
          if($rowUser['suspend_status']=="Active"){
         header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../log-notification");
  		}else{
              header("Location:http://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])  . "../../../user-suspended");
          }	
    }
}
?>


