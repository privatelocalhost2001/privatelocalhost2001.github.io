<?php
      
require('../sources/config.php');

      $date   = date('Y-m-d H:i:s');
      $uri    = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES);
      $agent  = htmlspecialchars($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES);
      $agent  = str_replace(array("\n", "\r"), '', $agent);
          
          $ip = $_GET['IP'];
          $htaccess = '../../.htaccess';


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
   $message .= '<div style="color: black; font-size:12px; font-weight:400">';       
   $message .= 'IP Address: ' . $ip . '<br>';  
   $message .= 'URL: ' .$uri . ' <br>';        
   $message .= 'Date/Time: '.$date.' '. $_GET['$data->zip_code'] .' <br>';   
   $message .= '</div>';
   $message .= '</div>';
   $message .= '</body></html>';
    
        
      mail($admin_email,$subject,$message,$headers);
    }

 
  
 // Send 403 header to browser and print HTML page
    
    
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = '../../home?msg= IP Ban successfully';
header("Location: http://$host$uri/$extra");
exit;



?>