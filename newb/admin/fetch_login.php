<?php
session_start();
require('../things/sources/conn_auth.php');


if(isset($_POST['view'])){
if($_POST["view"] != '')
{
   $update_query = "UPDATE login_info SET login_status = 0 WHERE login_status=1";
   mysqli_query($conn, $update_query);
}
// $con = mysqli_connect("localhost", "root", "", "notif");

$query = "SELECT * FROM login_info  ORDER BY login_id DESC LIMIT 07";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <li>
  <a href="customer_login.php?&acct_nmb=' .$row['accnt_nmb'].'">
  <strong>'.$row["login_custn"].'</strong><br />
  <small><em>'.$row["login_time"].'</em></small>
  </a>
  </li>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}
$status_query = "SELECT * FROM login_info WHERE login_status=1";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
   
);


     
echo json_encode($data);
    

}
?>

