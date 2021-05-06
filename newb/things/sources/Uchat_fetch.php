<?php
session_start();
require('conn_auth.php');
require('customInfo.php');
$MY_id = $rowUser['customer_id'];


if(isset($_POST['view'])){
if($_POST["view"] != '')
{
   $update_query = "UPDATE chat_table SET chat_status = 0 WHERE chat_status=1 And to_id ='".$MY_id."'";
   mysqli_query($conn, $update_query);
}
// $con = mysqli_connect("localhost", "root", "", "notif");
$query = "SELECT * FROM chat_table  ORDER BY chat_id DESC LIMIT 5";
$result = mysqli_query($conn, $query);
$output = '';

$status_query = "SELECT * FROM chat_table WHERE chat_status=1 And to_id ='".$MY_id."'";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'chat_content_info' => $output,
   'unseen_chat_notei'  => $count
);
echo json_encode($data);

}
?>