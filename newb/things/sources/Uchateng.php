<?php


include('config.php');

 define('EGG_HOST', $dbHost);
 define('EGG_USER', $dbUsername);
 define('EGG_PASSWORD', $dbPassword);
 define('EGG_DBNAME', $dbName);
 
 



class Chat{
    private $host  = EGG_HOST;
    private $user  = EGG_USER;
    private $password   = EGG_PASSWORD;
    private $database  = EGG_DBNAME;      
    private $chatTable = 'chat_table';
	private $chatUsersTable = 'customer_info';
	private $chatLoginDetailsTable = 'chat_table';
    private $admin = '0';
	private $dbConnect = false;
    
    
     public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	//public function loginUsers($username, $password){
		//$sqlQuery = "
		//	SELECT userid, username 
		//	FROM ".$this->chatUsersTable." 
		//	WHERE username='".$username."' AND password='".$password."'";		
       // return  $this->getData($sqlQuery);
	//}		
	public function chatUsers($customer_id){
		$sqlQuery = "
			SELECT * FROM ".$this->chatUsersTable." 
			WHERE customer_id = '$this->admin'";
		return  $this->getData($sqlQuery);
	}
	public function getUserDetails($customer_id){
		$sqlQuery = "
			SELECT * FROM ".$this->chatUsersTable." 
			WHERE customer_id = '$customer_id'";
		return  $this->getData($sqlQuery);
	}
	public function getUserAvatar($customer_id){
		$sqlQuery = "
			SELECT cust_photo 
			FROM ".$this->chatUsersTable." 
			WHERE customer_id = '$customer_id'";
		$userResult = $this->getData($sqlQuery);
		$userAvatar = '';
		foreach ($userResult as $user) {
			$userAvatar = $user['cust_photo'];
		}	
		return $userAvatar;
	}	
	public function updateUserOnline($customer_id, $online) {		
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET online = '".$online."' 
			WHERE customer_id = '".$customer_id."'";			
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
	}
    
	public function insertChat($to_id, $MY_ID, $my_name, $my_email, $chat_message, $my_photo) {	
          
		$sqlInsert = "
			INSERT INTO ".$this->chatTable." 
      (chat_id, chat_status, user_id, from_id, to_id, cust_name, cust_photo, email, chat_content, media, chat_date) 
			VALUES   (NULL, '1', '".$MY_ID."', '". $MY_ID ."', '". $to_id ."', '". $my_name ."', '". $my_photo ."', '". $my_email ."', '" . $chat_message ."', '', '" . date("d M Y, g:i a") . "')";
		$result = mysqli_query($this->dbConnect, $sqlInsert);
		if(!$result){
			return ('Error in query: '. mysqli_error());
		} else {
			$conversation = $this->getUserChat($from_id, $to_id);
			$data = array(
				"conversation" => $conversation			
			);
			echo json_encode($data);	
		}
	}
	public function getUserChat($from_user_id, $to_user_id) {
		$fromUserAvatar = $this->getUserAvatar($from_user_id);	
		$toUserAvatar = $this->getUserAvatar($to_user_id);			
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable." 
			WHERE (from_id = '".$from_user_id."' 
			AND to_id = '".$to_user_id."') 
			OR (from_id = '".$to_user_id."' 
			AND to_id = '".$from_user_id."') 
			ORDER BY chat_id ASC";
		$userChat = $this->getData($sqlQuery);	
		$conversation = '<ul>';
		foreach($userChat as $chat){
			$user_name = '';
			if($chat["from_id"] == $from_user_id) {
				$conversation .= '<li class="replies">';
				$conversation .= '<img width="22px" height="22px" src="things/upload/'.$fromUserAvatar.'" alt="" />';
			} else {
				$conversation .= '<li class="sent">';
				$conversation .= '<img width="22px" height="22px" src="things/upload/'.$toUserAvatar.'" alt="" />';
			}			
			$conversation .= '<p>'.$chat["chat_content"].'</p>';			
			$conversation .= '</li>';
		}		
		$conversation .= '</ul>';
		return $conversation;
	}
	public function showUserChat($from_user_id, $to_user_id) {		
		$userDetails = $this->getUserDetails($to_user_id);
		$toUserAvatar = '';
		foreach ($userDetails as $user) {
			$toUserAvatar = $user['cust_photo'];
			$userSection = '<img src="things/upload/'.$user['cust_photo'].'" alt="" />
				<p>'.$user['username'].'</p>
				<div class="social-media">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					 <i class="fa fa-instagram" aria-hidden="true"></i>
				</div>';
		}		
		// get user conversation
		$conversation = $this->getUserChat($from_user_id, $to_user_id);	
		// update chat user read status		
		$sqlUpdate = "
			UPDATE ".$this->chatTable." 
			SET chat_status = '0' 
			WHERE from_id = '".$to_user_id."' AND to_id = '".$from_user_id."' AND chat_status = '1'";
		mysqli_query($this->dbConnect, $sqlUpdate);		
		// update users current chat session
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET chat_current_session = '".$to_user_id."' 
			WHERE customer_id = '".$from_user_id."'";
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
		$data = array(
			"userSection" => $userSection,
			"conversation" => $conversation			
		 );
		 echo json_encode($data);		
	}	
	public function getUnreadMessageCount($senderUserid, $recieverUserid) {
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable."  
			WHERE from_id = '$senderUserid' AND to_id = '$recieverUserid' AND chat_status = '0'";
		$numRows = $this->getNumRows($sqlQuery);
		$output = '';
		if($numRows > 0){
			$output = $numRows;
		}
		return $output;
	}	
	public function updateTypingStatus($is_type, $loginDetailsId) {		
		$sqlUpdate = "
			UPDATE ".$this->chatLoginDetailsTable." 
			SET is_typing = '".$is_type."' 
			WHERE id = '".$loginDetailsId."'";
		mysqli_query($this->dbConnect, $sqlUpdate);
	}		
	public function fetchIsTypeStatus($customer_id){
		$sqlQuery = "
		SELECT is_typing FROM ".$this->chatLoginDetailsTable." 
		WHERE customer_id = '".$customer_id."' ORDER BY last_activity DESC LIMIT 1"; 
		$result =  $this->getData($sqlQuery);
		$output = '';
		foreach($result as $row) {
			if($row["is_typing"] == 'yes'){
				$output = ' - <small><em>Typing...</em></small>';
			}
		}
		return $output;
	}		
	public function insertUserLoginDetails($customer_id) {		
		$sqlInsert = "
			INSERT INTO ".$this->chatLoginDetailsTable."(customer_id) 
			VALUES ('".$customer_id."')";
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
        return $lastInsertId;		
	}	
	public function updateLastActivity($loginDetailsId) {		
		$sqlUpdate = "
			UPDATE ".$this->chatLoginDetailsTable." 
			SET last_activity = now() 
			WHERE id = '".$loginDetailsId."'";
		mysqli_query($this->dbConnect, $sqlUpdate);
	}	
	public function getUserLastActivity($customer_id) {
		$sqlQuery = "
			SELECT last_activity FROM ".$this->chatLoginDetailsTable." 
			WHERE customer_id = '$customer_id' ORDER BY last_activity DESC LIMIT 1";
		$result =  $this->getData($sqlQuery);
		foreach($result as $row) {
			return $row['last_activity'];
		}
	}	
}
?>