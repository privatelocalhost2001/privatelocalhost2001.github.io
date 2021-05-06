<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');

if(isset($_GET['id'])){
if($_GET['stat']=="On"){
$stat = "Off";
}else if($_GET['stat']=="Off"){
$stat = "On";
}else{
$stat = "On";
}
$updateVal = $conn->query("update customer_info set cust_trans_stat = '$stat' where customer_id = '" . $_GET['id'] . "'") or die($conn->error);
header("location:code_control.php");
}
?>