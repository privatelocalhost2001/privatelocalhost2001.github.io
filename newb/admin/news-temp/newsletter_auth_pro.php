<?php
// INIT + RUN SETTINGS
set_time_limit(0);
$each = 5;
$pause = 1;




include('../../things/sources/config.php');

// DATABASE SETTINGS
define('DB_HOST', $dbHost);
define('DB_NAME', $dbName);
define('DB_CHARSET', 'utf8');
define('DB_USER', $dbUsername);
define('DB_PASSWORD', $dbPassword);

// LOAD LIBRARY + EMAIL TEMPLATE FROM FILE
require __DIR__ . DIRECTORY_SEPARATOR . "newsletter_engin.php";



$news_content = $_POST['NEWS-TYPE'];
$news = new Newsletter();
$template = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $news_content );



if( $_POST['NEWS-TYPE']=="sales.php"){
    $subject = " [ $site_name ] Crazy sales ";
 
    
} elseif ( $_POST['NEWS-TYPE']=="missu.php") {
   $subject = "We miss you,   $site_name  Customer";
    
} elseif ( $_POST['NEWS-TYPE']=="loan.php") {
   $subject = "$site_name  Loan";
    
} elseif ( $_POST['NEWS-TYPE']=="newyear.php") {
   $subject = "Happy New Year from $site_name  ";    
    
}else{  
    $subject = "Just [ $site_name ]";
    }


// EMAIL SETTINGS
$headers = "From: $site_name <support@$domain>" . PHP_EOL;
$headers .= "Reply-To: support@$domain" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-Type: text/html; charset=ISO-8859-1" . PHP_EOL;
$news->prime($headers, $subject);
unset($subject); unset($headers);

// NOW TO SEND THE EMAIL - BATCH BY BATCH
$all = $news->count();
for ($i=0; $i<$all; $i+=$each) {
	$subscribers = $news->get($i,$each);
	foreach ($subscribers as $sub) {
		$msg = str_replace("[NAME]", $sub['cust_name'], $template);
		$news->send($sub['email'], $msg);
    // echo $msg."<br>";
	}
	sleep($pause);
}

header('location:../newsletter.php?msg=Newslatters has been successfully sent to all customers');
?>