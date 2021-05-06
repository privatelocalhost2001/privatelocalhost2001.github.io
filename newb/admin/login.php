<?php
session_start();
require('../things/sources/conn_auth.php');
require('../things/sources/customInfo.php');

switch($_REQUEST['action']){
case "Enter clearance code": 
$insVal = $conn->query("insert into inter_code (code_id, code_nmb, code_status) values (Null, '" . $_POST['clearance_code']. "', 'Available')") or die($conn->error);
header("location:view_code.php?type=clearance code");
break;

case "Enter tax code": 
$insVal = $conn->query("insert into tax_nmb (tax_id, tax_nmb, tax_stat, date) values (Null, '" . $_POST['tax_code']. "', 'Available', '" . date("Y-m-d") . "')") or die($conn->error);
header("location:view_code.php?type=Tax code");
break;

case "Enter Cot code": 
$insVal = $conn->query("insert into cot_nmb (cot_id, cot_nmb, cot_status) values (Null, '" . $_POST['cot_code']. "', 'Available')") or die($conn->error);
header("location:view_code.php?type=Cot code");
break;
        
 
        
        
              
 //NOTIFICATIN ALART       
        
case "Login-Notification":
$seLInfo = $conn->query("select * from all_notif") or die($conn->error);
$rowInfo = $seLInfo->fetch_array();
        
if($rowInfo['log_not']=="On"){
$stat = "Off";
}else if($rowInfo['log_not']=="Off"){
$stat = "On";
}else{
$stat = "On";
}
$updateVal = $conn->query("update all_notif set log_not = '$stat' ") or die($conn->error);
header("location:notifications.php");
break;
        
        
case "Transfer-Notification":
$seLInfo = $conn->query("select * from all_notif") or die($conn->error);
$rowInfo = $seLInfo->fetch_array();
if($rowInfo['trans_not']=="On"){
$stat11 = "Off";
}else if($rowInfo['trans_not']=="Off"){
$stat11 = "On";
}else{
$stat11 = "On";
}
$updateVal = $conn->query("update all_notif set trans_not = '$stat11' ") or die($conn->error);
header("location:notifications.php");
break;          
        

}


?>