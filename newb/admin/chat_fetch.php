<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');
$MY_id = $rowUser['customer_id'];

if(isset($_POST['view_chat'])){
if($_POST["view_chat"] != '')
{
    //chage message  WHERE messages_status= 1    if you want it to function
   $update_query = "UPDATE chat_table SET chat_status = 0 WHERE chat_status= 0";
   mysqli_query($conn, $update_query);
}
// $con = mysqli_connect("localhost", "root", "", "notif");

$query = "SELECT * FROM chat_table where user_id !='".$MY_id."' ORDER BY chat_id DESC LIMIT 5";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '<li><!-- start message -->
                    <a href="chat.php?&id=' .$row['from_id'].'">
                      <div class="pull-left">
                        <img src="../things/upload/'.$row["cust_photo"].'" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        .
                        <small><i class="glyphicon glyphicon-time"></i>'.$row["chat_date"].'</small>
                      </h4>
                      <p><h4>'.$row["cust_name"].'</h4></p>
                    </a>
                  </li>';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}
$status_query = "SELECT * FROM chat_table where user_id !='".$MY_id."' AND  chat_status=1";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'messages' => $output,
   'unseen_messages'  => $count
   
);

                             

     
echo json_encode($data);
    

}
?>


