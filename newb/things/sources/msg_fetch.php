<?php
session_start();
include('conn_auth.php');
include('customInfo.php');

if(isset($_POST['view'])){
if($_POST["view"] != '')
{
    
  
    
    
    
    $update_query = "UPDATE send_info SET info_status = 0 WHERE info_status=1  AND accnt_nmb = '" . $rowUser['acct_nmb'] . "' ";
   mysqli_query($conn, $update_query);
    
    
    


    

   mysqli_query($conn, $update_query);
}
// $con = mysqli_connect("localhost", "root", "", "notif");

$query = "SELECT * FROM send_info WHERE accnt_nmb = '" . $rowUser['acct_nmb'] . "' OR accnt_nmb = 'ALL' ORDER BY info_id DESC LIMIT 3";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <li >
   <a href="IMessage?&INFO=' .$row['info_id'].'" class="">
  <strong >'.$row["info_sbj"].'</strong><br />
  <small><em>'.$row["info_date"].'</em></small>
  </a>
  </li>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
}
$status_query = "SELECT * FROM send_info WHERE accnt_nmb = '" . $rowUser['acct_nmb'] . "' AND info_status=1";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);

}
?>

