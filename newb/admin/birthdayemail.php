<?php 
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/config.php');




 








if(($_GET['PURPOSE']=="BDAY")){
    


                          $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
				          $custPass = $conn->query("select * from user_table where cust_id = '" . $_GET['id'] . "'") or die($conn->error);
						   $rowP = $custPass->fetch_assoc();
						


$subject = 'Happy Birthday';    
$to = $rowInfo['email'];
$from ="support@$domain";
$noreply="noreply@$domain";


 
// To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
 $adddate2=date(" d M Y ");
$headers = "From:' $site_name'<support@$domain>\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$trans_id = substr(time()*rand(), 0, 14);
// Create email headers

$headers .= "Bcc: aturosandaval@gmail.com \r\n";


        
        
        // customer email hearders
$subject2 = $message_subject;
$headers2 = "From:'Admin Mailer To $site_name'<transfer@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 


    
 
// Compose a simple HTML email message
$message = '<html><body>';
 
 $message .='<div style="padding: 9px;">
<table style="height: 835px; background-color: #e4f2ec; width: 641px;" border="0" width="675" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 600px;">
<td style="height: 716px; width: 654px;" valign="top" bgcolor="#FEFEFE">
<table style="height: 204px;" border="0" width="650" cellspacing="0" cellpadding="0" align="center">
<table width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="left">
 <p><span style="font-size: 18pt; color: gray;">Hello '.$rowInfo['cust_name'] . ',</span></p>
</td>
</tr>
</tbody>
</table>
<table width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 192px;">
<td style="height: 192px; width: 650px;" valign="top"><img style="display: block;" src="'.$site_url.'/things/img/birthdaypics.jpg" alt="Birthday" width="800" height="568" /></td>
</tr>
</tbody>
</table>
<tbody>
   <tr  align="center">
    <td valign="top" possition="center" width="50%"><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/fb_purple.png" width="52" height="52" border="0" /></a><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/twt_purple.png" width="52" height="52" border="0" /></a><a href="http://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img src="'.$site_url.'/things/img/LkdIn_purple.png" width="52" height="52" border="0" /></a><img src="'.$site_url.'/things/img/Ig_purple.png" width="52" height="52" /><a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" ><img src="'.$site_url.'/things/img/Whatsapp_purple.png" width="52" height="52" /></a></td>
      <p>&nbsp;</p>
      <p></p>
   </tr>
<tr>
    <td style="width: 631px;" valign="top" bgcolor="#FFFFFF"><span style="color: #9297a3;"><span>For more information on our products and services, please call our 24/7 contact centre on '.$admin_phone.'</span></span>&nbsp;<span style="color: #9297a3;"><span>or chat with us via</span></span><span style="color: #5c068c;"><span>  Whatsapp on  <a href="https://wa.me/'.$admin_whatsapp.'" target="_blank" >'.$admin_phone.'</a></span></span>&nbsp;<span style="color: #efefef;"></span><span style="color: #9297a3;"> Alternatively send an email to</span> <span style="color: #9297a3;">'.$admin_email.'</span><br></td>
</tr>
    
<tr align="center">
    <td>
    <p><span align="center" style="font-size: 10pt; color: #363636;" > Copyright  2021. '.$site_name.' </span></p> </td>
    </tr>
      

</tbody>
</table>
</tr>
</tbody>
</table>  
<p>&nbsp;</p>
<p></p>';


$message .= '</div>';
$message .= '</body></html>';
    
    
    

    
 
// Sending email
    {   
    mail($admin_email,$subject2,$message,$headers2);
    }


  
 
if(mail($to,$subject,$message,$headers)){
    

        header('location:index.php?msg=🎂 Birthday message sent to '.$rowInfo['cust_name'] . '');
    }
 
}

 
?>