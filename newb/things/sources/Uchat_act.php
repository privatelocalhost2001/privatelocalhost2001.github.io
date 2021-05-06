<?php
session_start();
require('conn_auth.php');
include('customInfo.php');
include ('UChateng.php');
$MY_ID = $rowUser['customer_id'];
$chat = new Chat();
if($_POST['action'] == 'update_user_list') {
	$chatUsers = $chat->chatUsers($MY_ID);
	$data = array(
		"profileHTML" => $chatUsers,	
	);
	echo json_encode($data);	
}




   

    if($_POST['action'] == 'insert_chat') {
	
     $selSender = $conn->query("select * from customer_info where customer_id = '" . $MY_ID . "'") or die($conn->error);
     $rowSender = $selSender->fetch_array();  
        
     $selReceiver = $conn->query("select * from customer_info where customer_id = '" . $_POST['to_user_id'] . "'") or die($conn->error);
     $rowReceiver = $selReceiver->fetch_array(); 
        
    
$chat->insertChat($_POST['to_user_id'], $MY_ID, $rowSender['cust_name'], $rowSender['email'], $_POST['chat_message'], $rowSender['cust_photo'] );    
        
        
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
        
        
 
         

    $to = $rowReceiver['email'];
        
    $subject = "Customer DashBoard $site_name";
    $Sname = $rowSender['cust_name'];
    $Semail = $rowSender['email'];
	$content = $_POST['chat_message'];
   	$mailHeaders = "From: " . $rowSender['cust_name'] . "<". $rowSender['email'] .">\r\n";
	mail($to, $subject, $content, $mailHeaders);
        
        
    
}





if($_POST['action'] == 'show_chat') {
	$chat->showUserChat($MY_ID, $_POST['to_user_id']);
}
if($_POST['action'] == 'update_user_chat') {
	$conversation = $chat->getUserChat($MY_ID, $_POST['to_user_id']);
	$data = array(
		"conversation" => $conversation			
	);
	echo json_encode($data);
}
if($_POST['action'] == 'update_unread_message') {
	$count = $chat->getUnreadMessageCount($_POST['to_user_id'], $MY_ID);
	$data = array(
		"count" => $count			
	);
	echo json_encode($data);
}
if($_POST['action'] == 'update_typing_status') {
	$chat->updateTypingStatus($_POST["is_type"], $_SESSION["login_details_id"]);
}
if($_POST['action'] == 'show_typing_status') {
	$message = $chat->fetchIsTypeStatus($_POST['to_user_id']);
	$data = array(
		"message" => $message			
	);
	echo json_encode($data);
}

if($_POST['action'] == 'Check username') {
$content = $_POST['Fugmess'];
$to_id = $_POST['to_id'];
$date =  date("d M Y, g:i a");
    
$create = $conn->query("insert into chat_table (chat_id, chat_status, user_id, from_id, to_id, cust_name, email, chat_content, media, messages_date) values (NULL, '1', '".$MY_ID."', '". $MY_ID ."', '". $to_id ."', 'ADMIN', 'ADMINEMAIL', '" . $content ."', '', '" . $date . "')") or die($conn->error);

    if($create){
echo 1;
}else{
echo 0;
}
}
?>