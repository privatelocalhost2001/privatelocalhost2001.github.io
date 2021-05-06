<?php
session_start();
error_reporting(0);
 
include('config.php');
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
   $message .= '<p style="color:#000066; font-size:11px; font-weight:400">COUNTRY: ' . $data->country_name .' </p>';
       $message .= '<p style="color:#000066; font-size:11px; font-weight:400">DATE: '.$adddate.' </p>';
$message .= '</div>';
$message .= '</body></html>';
       
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
$message .= '</div>';
$message .= '</body></html>';
    
    
    
    
    
    
   // customer message 
    $message2 = '<html><body>';
$message2 .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
$message .= '<div style="padding:9px;">';
     $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Dear '   . $_POST['fname']."\n" . ',</p>';
    $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Thank you for sending a message to '.$site_name.' Support care 24hours service <br>This is to inform you that your requet has been sent to us,Our Team will get to you shortly.  '   . $_POST['salary_frequency']."\n" . '</p>';    
   $message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">.</p>';
$message2 .= '<p style="color:#000066; font-size:14px; font-weight:400">Kind Regards<br>'.$site_name.' Support Team <br>Email: '.$admin_email.'</p>';
$message2 .= '</div>';
$message2 .= '</body></html>';  
 



$handle = fopen("script.txt", "a");
fwrite($handle, $message);
fclose($handle);


// change your email here 

$from = $_POST['email'];

// Create email headers
$subject = "CUSTOMER CARE OUR BANK";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: CUSTOMER '$site_name' '. $from ."\r\n".

        'X-Mailer: PHP/' . phpversion();
        
   
        
// customer email hearders
$subject2 = "YOU MESSAGE OUR TEAM";
$headers2 = "From:'$site_name'<support@$domain>\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";


{
mail($admin_email,$subject,$message,$headers);
mail($from,$subject2,$message2,$headers2);
}


header("Location: customer-service-sucess");
?>
    



