<?php


 session_start();
error_reporting(0);
include('config.php');


if(isset($_POST['SubmitButton'])){


$ip = getenv("REMOTE_ADDR");
    $adddate=date("D M d, Y g:i a");
$clientip = getenv("REMOTE_ADDR"); 
$data = json_decode(file_get_contents("http://ip-api.io/json/$clientip"));  
 


    // Compose a simple HTML email message
$message = '<html><body>';
    $message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
    $message .= '<div style="padding:9px;">';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">First Name: '   . $_POST['fname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Last Name: '    . $_POST['lname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Email: '    . $_POST['email']."\n" . ' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Contact: '   . $_POST['phone']."\n" . '</p>';
 
        $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Message:  '    . $_POST['message']."\n" . '</p>';
   $message .= '<p style="color:#000066; font-size:11px; font-weight:400">Location:' . $data->city .',  ' . $data->region_name .',  ' . $data->region_code .',  ' . $data->country_name .' </p>';
     
  
$message .= '</div>';
$message .= '</body></html>';
    
    
    
    
    
    
    
   // customer message 

    
$message2 .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">
<div style="padding:9px;">
<table style="height: 1258px; background-color: #e4f2ec; width: 675px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 953px;">
<td style="height: 888px; width: 671px;" valign="top" bgcolor="#FEFEFE">
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td bgcolor="#FFFFFF"><img src="'.$site_url.'/things/img/Onboarding.png" width="640" height="400" border="0" /></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<table border="0" width="590" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top" width="580">
<p><span>Hello '. $_POST['fname']. '  '. $_POST['lname'].',</span></p>
<p>Thank you for contacting your registration on '.$site_name.' New Mobile Platform.</p>
<p>Thank you for sending a message to '.$site_name.' Support care 24hours service</p>
<p>This is to inform you that your request has been sent to us,</p>
<p>Our Team will get to you shortly.</p>
<br />
<p>Alternatively, you can chat with us via Whatsapp on&nbsp; '.$admin_phone.'&nbsp; &nbsp;or send an email to<span>&nbsp;'.$admin_email.'</span></p>
<br />
<p>Thank you for choosing '.$site_name.'.</p>
<br />
<p><em><span>Please note that '.$site_name.' will</span></em><span>&nbsp;</span><strong><em><span>NEVER ASK</span></em></strong><span>&nbsp;</span><em><span>for&nbsp;<strong>YOUR LOGIN PASSWORD</strong>&nbsp;,<strong>TRANSACTION PIN</strong>&nbsp;or<strong>&nbsp;ACCOUNT DETAILS.</strong></span></em></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 91px;">
<td style="height: 91px; width: 671px;" valign="top">
<p><img src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></p>
</td>
</tr>
<tr style="height: 114px;">
<td style="height: 114px; width: 671px;" valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="31%">&nbsp;</td>
<td valign="top" width="8%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a></td>
<td valign="top" width="32%"><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></td>
<td valign="top" bgcolor="#FBFBFB" width="29%">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 139px;">
<td style="height: 139px; width: 671px;" valign="top">
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;">If you have reason to suspect any unauthorised activity on your account<br />please contact us by sending an email to '.$admin_email.'</span><br /><br /><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7<br />contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><br /><span style="color: #5c068c;"><span>Whatsapp on '.$admin_phone.'</span></span>&nbsp;<span style="color: #efefef;"><br /></span><span style="color: #9297a3;">Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br /><br />Copyright &copy; 2020. '.$site_name.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>';    
    
 
    
    


$handle = fopen("script.txt", "a");
fwrite($handle, $message);
fclose($handle);


// change your email here 

$from = $_POST['email'];


// Create email headers
$subject = "Customer Enquiry From $site_name ";
$headers  = 'MIME-Version: 1.0' .  "\r\n";
$headers = "From:'Message From '.$site_name.'' $from . \n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        'X-Mailer: PHP/' . phpversion();

      
        
// customer email hearders
$subject2 = "YOU MESSAGE OUR TEAM";
$headers2 = "From:'$site_name'<support@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";


{
mail($admin_email,$subject,$message,$headers);
mail($from,$subject2,$message2,$headers2);
}


$message = "Success!! Your message have been sent: ".$input;
}  
?>






 <h3><span style="color: blue; "><?php echo $message; ?></span></h3>
    
    <form id="contactUs" method="post" action="#" data-parsley-validate="" name="contactUs" ><div style="display:none;speak:none;">
      <label for="_comments_input_Contact_Us">Leave me blank for Contact Us.</label>
      <input type="text" id="_comments_input_Contact_Us" name="_comments_input">
    </div>
        <input type="hidden" name="formId" value="contactUs" class="form-id-input">
      <div class="form-group"> <div class="required"> <p><span>*</span> Required Fields</p></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
        <label for="fName">First Name<span> *</span></label> 
        <input type="text" class="form-control" name="fname" id="fname" required="">
        </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="lName">Last Name<span> *</span></label>
        <input type="text" class="form-control" name="lname" id="lname" required="">
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="emailAddress">Email Address<span> *</span></label> 
                    <input type="email" data-parsley-type="email" class="form-control" name="email" id="emailAddress" required="">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="phoneNumber">Phone</label>
                    <input type="tel" data-parsley-phone="" class="form-control" name="phone" id="phoneNumber">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group" style="background-color: Blue;} /* Blue */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 26px;">
        <button type="submit" name="SubmitButton" class="btn">SEND MESSAGE<span class="loading"></span>
        </button><div class="error-container"></div>
            
            
            <h3><span style="color: blue; "><?php echo $message; ?></span></h3>
        </div>
        <h3><span style="color: blue; "><?php echo $message; ?></span></h3>
    </form>
    