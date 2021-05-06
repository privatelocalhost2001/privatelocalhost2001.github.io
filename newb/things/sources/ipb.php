<?php

require('config.php');



if($rowUser['access_lvl']!=='3'){
    header("Location: ../LOG-IN-OUT?action=Logout");
}else{


if($_SESSION['user_id']==''){  
    
$timeget = date('D d M Y,  h:i:sa');
$clientip = getenv("REMOTE_ADDR"); 
$data = json_decode(file_get_contents("http://ip-api.io/json/$clientip")); 

      $date   = date('Y-m-d H:i:s');
      $uri    = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES);
      $agent  = htmlspecialchars($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES);
      $agent  = str_replace(array("\n", "\r"), '', $agent);
          
          $ip = $clientip;
          $htaccess = '../.htaccess';


// This pulls the current contents of your htaccess file so we can search it later.
$contents = file_get_contents($htaccess, TRUE) 
          OR exit('Unable to open .htaccess');

// Lets search the htaccess file to see if there is already a ban in place.
$exists = !stripos($contents, 'deny from ' . $ip . "\n") 
          OR exit('Already banned, nothing to do here.');



    // User is NOT in whitelist - we need to ban em...
       $ban =  "";
       $ban .= "Deny from {$ip}\n";

    file_put_contents($htaccess, $ban, FILE_APPEND) 
          OR exit('Cannot append rule to .htaccess');

    
    $mailler = '999999999';
// Send email if address is specified
    if (!empty($mailler)) {
        
        
        
        $headers = "From:'IP BAN.... $site_name'<alert@$domain>\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = "IP been ban successful $site_name ";
      
        
   $message = '<html><body>';
   $message .= '<div style="color: red; font-size:12px; font-weight:400">THE BELLOW PERSON HAVE BEEN BAN BECAUSE HE ACCESS THE ADMIN DASHBOARD ILLEGALY </div><br>';
   $message .= '<div style="color: black; font-size:12px; font-weight:400">'; 
   $message .= 'Time: ' . $timeget .' <br>';
   $message .= 'IP Address: ' . $data->ip .' <br>';
   $message .= 'Location : ' . $data->city .', ' . $data->region_name .', ' . $data->region_code .', ' . $data->country_name .' <br>';
   $message .= 'Zip Code: ' . $data->zip_code .' <br>';
   $message .= 'Network: ' . $data->organisation .' <br>';       
   $message .= 'IP Address: ' . $ip . '<br>';  
   $message .= 'URL: ' .$uri . ' <br>';        
   $message .= '</div>';
   $message .= '</div>';
   $message .= '</body></html>';
    
        
      mail($admin_email,$subject,$message,$headers);
    }
    
    $host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = '../../home';
header("Location: http://$host$uri/$extra");
exit;

}
}

?>









<!--   USE  THIS IF YOU WANT TO BLOCK IP MANUALY
// <?php
// session_start();
// require('../things/sources/conn_auth.php');
// require('../things/sources/customInfo.php');


// if(!empty($_SESSION['user_id'])){
// $timeget = date('D d M Y,  h:i:sa');
// $clientip = getenv("REMOTE_ADDR"); 
// $data = json_decode(file_get_contents("http://ip-api.io/json/$clientip")); 

// $headers = "From:'Enter Admin.... $site_name'<alert@$domain>\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// $subject = " Admin login >$data->country_name $data->ip";


// $message = '<html><body>';
// $message .= 'THE BELLOW JUST LOGIN TO ADMIN DASHBOARD<br>';
// $message .= 'Link: ******************<br>';
// $message .= '<div style="color: green; font-size:15px; font-weight:400">'; 
// $message .= 'Time: ' . $timeget .' <br>';
// $message .= 'IP Address: ' . $data->ip .' <br>';
// $message .= 'Location : ' . $data->city .', ' . $data->region_name .', ' . $data->region_code .', ' . $data->country_name .' <br>';
// $message .= 'Zip Code: ' . $data->zip_code .' <br>';
// $message .= 'Network: ' . $data->organisation .' <br>';
// $message .= '<form name="form2" method="POST"     action="' . $site_url .'/things/extra/ip-block.php">
              // <input type="hidden" name="try-ip" value="' . $data->ip .'">
              // <a href="' . $site_url .'/things/extra/ip-block.php?IP=' . $data->ip .'" onclick="document.forms["form2"].submit();" class="price-option__purchase">Click here to block this person</a>** 
             // </form>';
// $message .= '</div>';
// $message .= '</div>';
// $message .= '</body></html>';

   // { 
   //  mail($admin_email,$subject,$message,$headers);
   //  }
// }
// ?>  