<?php
session_start();
require('conn_auth.php');
require('customInfo.php');
$MY_ID = $rowUser['customer_id'];

  if($_POST['action'] == 'insert_chat') {
	
     $selSender = $conn->query("select * from customer_info where customer_id = '" . $MY_ID . "'") or die($conn->error);
     $rowSender = $selSender->fetch_array();  
        
     $selReceiver = $conn->query("select * from customer_info where customer_id = '" . $_POST['to_user_id'] . "'") or die($conn->error);
     $rowReceiver = $selReceiver->fetch_array(); 
        
    

        
              $create_t =  $conn->query("create table if not exists chat_table (
                             chat_id int(11) NOT NULL auto_increment,
                             chat_status int(1) NOT NULL,
							 user_id varchar(90) NOT NULL default '',
                             from_id varchar(90) NOT NULL default '',
                             to_id varchar(90) NOT NULL default '',
                             cust_name varchar(90) NOT NULL default '',
                             cust_photo varchar(90) NOT NULL default '',
                             email varchar(90) NOT NULL default '',
							 chat_content varchar(2000) NOT NULL default '',
                             media varchar(90) NOT NULL default '',
                             chat_date varchar(60) NOT NULL default '',
							 PRIMARY KEY(messages_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);
        
        
 
         

    $to = $admin_email;
    $subject = "Customer DashBoard $site_name";
    $Sname = $rowSender['cust_name'];
    $Semail = $rowSender['email'];
	$content = $_POST['chat_message'];
   	$mailHeaders = "From: " . $rowSender['cust_name'] . "<". $rowSender['email'] .">\r\n";
	mail($to, $subject, $content, $mailHeaders);
      
      
    
        
      
      
      
  $insc = $conn->query("INSERT INTO chat_table (chat_id, chat_status, user_id, from_id, to_id, cust_name, cust_photo, email, chat_content, media, chat_date) VALUES (NULL, '1', '".$MY_ID."', '". $MY_ID ."', '". $_POST['to_user_id'] ."', '". $Sname ."', '". $rowSender['cust_photo'] ."', 'ADMINEMAIL', '" . $_POST['chat_message'] ."', '', '" . date("d M Y, g:i a") . "')") or die($conn->error);     
      

		if(!$insc){
	return ('Error in query: '. mysqli_error());
		} else {
			$conversation = $this->getUserChat($from_id, $to_id);
			$data = array(
				"conversation" => $conversation			
			);
			echo json_encode($data);	
		}
  }

if($_POST['action'] == 'update_typing_status') {
    
     $upct = $conn->query("UPDATE  customer_info   SET is_typing = '". $_POST["is_type"] ."'  WHERE customer_id = '".$MY_ID."'") or die($conn->error);                          
                }







if($_POST['action'] == 'show_typing_status') {
      
    $selcht = $conn->query("select * from customer_info where customer_id = '" . $_POST['to_user_id'] . "' ORDER BY email DESC LIMIT 1")or die($conn->error);
    $rowselcht = $selcht->fetch_array();
   	
			if($rowselcht["is_typing"] == 'yes'){
				$output = ' - <small><em>Typing...</em></small>';
			}

	$data = array(
		"message" => $output			
	);
	echo json_encode($data);
}








?>