   <?php



include('../sources/conn_auth.php');

$fakeid = "3";

 $selCuInfo = $conn->query("select * from customer_info where customer_id = '" . $fakeid . "'") or die($conn->error);
                $rowUser = $selCuInfo->fetch_array();


if(isset($_POST['send'])){
    

    
 
if(!empty($_POST["send"])) {
    $subject = "Customer DashBoard $site_name";
    $name = $rowUser['cust_name'];
    $email = $rowUser['email'];
	$content = $_POST["messages_content"];
   	$mailHeaders = "From: " . $name . "<". $email .">\r\n";
	if(mail($admin_email, $subject, $content, $mailHeaders)) {
	    $message = "Your contact information is received successfully.";
	    $type = "success";
	}
}
    

 
    
$idyo = $rowUser['customer_id'];    


    
 
$create_t =  $conn->query("create table if not exists messages_info (
                             messages_id int(11) NOT NULL auto_increment,
                             messages_status int(1) NOT NULL,
							 user_id varchar(90) NOT NULL default '',
                             from_id varchar(90) NOT NULL default '',
                             to_id varchar(90) NOT NULL default '',
                             cust_name varchar(90) NOT NULL default '',
                             email varchar(90) NOT NULL default '',
							 messages_content varchar(2000) NOT NULL default '',
                             media varchar(90) NOT NULL default '',
                             messages_date varchar(60) NOT NULL default '',
							 PRIMARY KEY(messages_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);

 
$create = $conn->query("insert into messages_info (messages_id, messages_status, user_id, from_id, to_id, cust_name, email, messages_content, media, messages_date) values (NULL, '1', '" .$idyo. "', '" .$idyo. "', '999', '" . $name . "', '" . $email . "', '" . $content ."', '', '" . date("d M Y, g:i a") . "')") or die($conn->error);
    
header('location:sidebareng.php?msg=Notification update  successfully for '. $rowUser['cust_name'] . '&id=' .$idyo);    
}
?>




  

    
    
    <?php
    function Wo_CreateNewVideoCall($re_data) {
    global $wo, $sqlConnect;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($re_data)) {
        return false;
    }
    $user_data  = Wo_UserData($re_data['from_id']);
    $user_data2 = Wo_UserData($re_data['to_id']);
    if (empty($user_data) || empty($user_data2)) {
        return false;
    }
    $logged_user_id    = Wo_Secure($wo['user']['user_id']);
    $query1            = mysqli_query($sqlConnect, "DELETE FROM " . T_VIDEOS_CALLES . " WHERE `from_id` = {$logged_user_id} OR `to_id` = {$logged_user_id}");
    $re_data['active'] = 0;
    $re_data['called'] = $re_data['from_id'];
    $re_data['time']   = Wo_Secure(time());
    $fields            = '`' . implode('`, `', array_keys($re_data)) . '`';
    $data              = '\'' . implode('\', \'', $re_data) . '\'';
    $query             = mysqli_query($sqlConnect, "INSERT INTO " . T_VIDEOS_CALLES . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return mysqli_insert_id($sqlConnect);
    } else {
        return false;
    }
}








function Wo_GetMessages($data = array(), $limit = 50) {
    global $wo, $sqlConnect;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $message_data   = array();
    $user_id        = Wo_Secure($data['user_id']);
    $logged_user_id = Wo_Secure($wo['user']['user_id']);
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    $query_one = " SELECT * FROM " . T_MESSAGES;
    if (isset($data['new']) && $data['new'] == true) {
        $query_one .= " WHERE `seen` = 0 AND `from_id` = {$user_id} AND `to_id` = {$logged_user_id} AND `deleted_two` = '0'";
    } else {
        $query_one .= " WHERE ((`from_id` = {$user_id} AND `to_id` = {$logged_user_id} AND `deleted_two` = '0') OR (`from_id` = {$logged_user_id} AND `to_id` = {$user_id} AND `deleted_one` = '0'))";
    }
    if (!empty($data['message_id'])) {
        $data['message_id'] = Wo_Secure($data['message_id']);
        $query_one .= " AND `id` = " . $data['message_id'];
    } else if (!empty($data['before_message_id']) && is_numeric($data['before_message_id']) && $data['before_message_id'] > 0) {
        $data['before_message_id'] = Wo_Secure($data['before_message_id']);
        $query_one .= " AND `id` < " . $data['before_message_id'] . " AND `id` <> " . $data['before_message_id'];
    } else if (!empty($data['after_message_id']) && is_numeric($data['after_message_id']) && $data['after_message_id'] > 0) {
        $data['after_message_id'] = Wo_Secure($data['after_message_id']);
        $query_one .= " AND `id` > " . $data['after_message_id'] . " AND `id` <> " . $data['after_message_id'];
    }
    if (!empty($data['type']) && $data['type'] == 'user') {
        $query_one .= " AND `page_id` = 0 ";
    }
    $sql_query_one    = mysqli_query($sqlConnect, $query_one);
    $query_limit_from = mysqli_num_rows($sql_query_one) - 50;
    if ($query_limit_from < 1) {
        $query_limit_from = 0;
    }
    
    if (isset($limit)) {
        $query_one .= " ORDER BY `id` ASC LIMIT {$query_limit_from}, 50";
    }
    $query = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['messageUser'] = Wo_UserData($fetched_data['from_id']);
        $fetched_data['text']        = Wo_Markup($fetched_data['text']);
        $fetched_data['text']        = Wo_Emo($fetched_data['text']);
        $fetched_data['onwer']       = ($fetched_data['messageUser']['user_id'] == $wo['user']['user_id']) ? 1 : 0;
        if (!empty($fetched_data['stickers']) && !Wo_IsUrl($fetched_data['stickers'])) {
            $fetched_data['stickers'] = Wo_GetMedia($fetched_data['stickers']);
        }
        $message_data[]              = $fetched_data;
        if ($fetched_data['messageUser']['user_id'] == $user_id && $fetched_data['seen'] == 0) {
            mysqli_query($sqlConnect, " UPDATE " . T_MESSAGES . " SET `seen` = " . time() . " WHERE `id` = " . $fetched_data['id']);
        }
    }
    return $message_data;
}






    ?>
    
    
    
    







<style>
body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
   }
   * {
      box-sizing: border-box;
   }
   .openChatBtn {
      background-color: rgb(123, 28, 179);
      color: white;
      padding: 16px 20px;
      border: none;
      font-weight: 500;
      font-size: 18px;
      cursor: pointer;
      opacity: 0.8;
      position: center;
     
   }
   .openChat {
      display: none;
      position: center;
           border: 3px solid #ff08086b;
      z-index: 9;
   }
  
</style>  






                          
                                <li class="nav-item  ">
                            <a onclick="openForm()" class="nav-link">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <span class="title" >Feedback</span>
                                <span class="arrow"></span>
                            </a> 
<div class="openChat"   style=" max-width: 300px; padding: 5px; background-color: white;">

    
    
    <form method="post" action="" >
<label for="msg"><b>Message</b></label>
<textarea style=" width: 100%;  font-size: 18px; padding: 5px; margin: 5px 0 5px 0; border: none; font-weight: 500; background: #d5e7ff; color: rgb(0, 0, 0);  resize: none; min-height: 150px;   (textarea:focus background-color: rgb(219, 255, 252));
      outline: none;" placeholder="Type message.." name="messages_content" required></textarea>
        
<button  style=" background-color: rgb(34, 197, 107); color: white; padding: 8px 20px; font-weight: bold; border: none; cursor: pointer;  width: 50%; margin-bottom: 5px;  opacity: 0.8;
   "  type="submit" class="btn send" name="send" value="send" >Send</button>
        
<button style=" background-color: red; color: white; padding: 8px 20px; font-weight: bold; border: none; cursor: pointer; width: 50%; margin-bottom: 5px; opacity: 0.8; (hover opacity: 1);"  type="button" class="btn close" onclick="closeForm()">Close </button>
     <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
</form>
</div>        
                           </li>
     
      
   <script>
   document .querySelector(".openChatBtn") .addEventListener("click", openForm);
   document.querySelector(".close").addEventListener("click", closeForm);

   function openForm() {
      document.querySelector(".openChat").style.display = "block";
   }
   function closeForm() {
      document.querySelector(".openChat").style.display = "none";

        }           
</script>   
     
      
  
     
   


 