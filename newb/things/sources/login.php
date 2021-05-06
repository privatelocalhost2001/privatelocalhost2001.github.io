<?php
session_start();
require('conn_auth.php');

function clean($str) {
global $conn;
    $str = @trim($str);
    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return $conn->real_escape_string($str);
}




switch($_REQUEST['action']){
case "Check username":
        
$selUser = $conn->query("select * from customer_info where username = '" . $_POST['account'] . "' OR acct_nmb = '" . $_POST['account'] . "'") or die($conn->error);
if($selUser->num_rows>0){
echo 1;
}else{
echo 0;
}
break;
case "login user":
$account = $_POST['account'];
$passwrd = $_POST['passwrd'];

$selPass = $conn->query("select * from customer_info where username = '$account' OR acct_nmb = '$account' && pass = '$passwrd'") or die($conn->error);
if($selPass->num_rows>0){
$rowD = $selPass->fetch_assoc();
echo 1;
    
    
$_SESSION['user_id'] =  $rowD['customer_id'];
$_SESSION['username'] = $rowD['username'];
$_SESSION['cust_name'] = $rowD['cust_name'];
}else{
echo 0;
}
        
       
        
break;
case "Start transfer":
$sel_credit = $conn->query("select *, sum(amt_cred) as totalCredit, sum(amt_dep) as totalDebit from credit_info where accnt_nmb = '" . $_POST['acct_nmb'] . "' group by accnt_nmb") or die($conn->error);
$rowBal = $sel_credit->fetch_array();
$bal = $rowBal['totalCredit'] - $rowBal['totalDebit'];
if($bal < $_POST['amt_trans']){
echo 0;
}else{
$insSql = $conn->query("insert into transfer_info (trans_id, acct_nmb, to_accnt, ben_name, ben_phn, bank_name, country_user, swift_code, sort_code, amt_trans, trans_stat, date_trans) values (NULL, '" . $_POST['acct_nmb'] . "', '" . $_POST['to_accnt'] . "', '" . $_POST['ben_name'] . "', '" . $_POST['ben_phn'] . "', '" . $_POST['bank_name'] . "', '" . $_POST['countryCode'] . "', '" . $_POST['swift_code'] . "', '56578', '" . $_POST['amt_trans'] . "', 'pending', '" . date("Y-m-d H:i:s") . "')") or die($conn->error);
if($insSql){
$lastCon = $conn->insert_id;
echo $lastCon;
}
}

break;

case "Edit user profile":
$ins = $conn->query("update customer_info set

 cust_name = '" . $_POST['cust_name'] . "', 
 email = '" . $_POST['email'] . "', 
 phn_nmb = '" . $_POST['phn_nmb'] . "', 
 addrs = '" . $_POST['addrs'] . "', 
 username = '" . $_POST['username'] . "',
 day_birth = '" . $_POST['day_birth'] . "',
 country = '" . $_POST['country'] . "',
 swift_code = '" . $_POST['swift_code'] . "', 
 zip_code = '" . $_POST['zip_code'] . "' where customer_id = '" . $_POST['cust_id']. "'") or die($conn->error);
        
 
      
header("location:edit-profile");
break;

case "Logout":
// chat   online status
$ins = $conn->query("update customer_info set online = 0  WHERE customer_id =  '" . $_GET['id'] . "' ") or die($conn->error);         
session_unset();
session_destroy();       
header("location: home?msg=You Have Logged Out successfully ");
break;



case "Confirm Code":    
if(preg_match("/[^a-zA-Z0-9]+/", $_POST['code_id'])){
echo 0; 
}else{
$selCode = $conn->query("select * from bill_code where code_n = '" . $_POST['code_id'] . "' && stage_name = 1") or die($conn->error);
if(!$selCode->num_rows){
echo 0;
}else{
echo $_POST['trans_id']; 
}
}
break;
case "Confirm Tax":
if(preg_match("/[^a-zA-Z0-9]+/", $_POST['tax_nmb'])){
echo 0; 
}else{        
$selCode = $conn->query("select * from bill_code where code_n = '" . $_POST['tax_nmb'] . "' && stage_name = 2") or die($conn->error);
if(!$selCode->num_rows){
echo 0;
}else{
echo $_POST['trans_id']; 
}
}
break;
case "Confirm Clearance":
if(preg_match("/[^a-zA-Z0-9]+/", $_POST['clearance_nmb'])){
echo 0; 
}else{        
$selCode = $conn->query("select * from bill_code where code_n = '" . $_POST['clearance_nmb'] . "' && stage_name = 3") or die($conn->error);
if(!$selCode->num_rows){
echo 0;
}else{
echo $_POST['trans_id']; 
}
}
break;
case "Confirm Validation":
if(preg_match("/[^a-zA-Z0-9]+/", $_POST['validation_nmb'])){
echo 0; 
}else{        
$selCode = $conn->query("select * from bill_code where code_n = '" . $_POST['validation_nmb'] . "' && stage_name = 4") or die($conn->error);
if(!$selCode->num_rows){
echo 0;
}else{
echo $_POST['trans_id']; 
}
}
        
        
        
// DISSABLED:  ECEPT THE 5TH BILLING STAGE IS REQUIRED         
break;
case "Confirm xtreme stage":
if(preg_match("/[^a-zA-Z0-9]+/", $_POST['xtreme_code'])){
echo 0; 
}else{         
$selCode = $conn->query("select * from bill_code where code_n = '" . $_POST['xtreme_code'] . "' && stage_name = 5") or die($conn->error);
if(!$selCode->num_rows){
echo 0;
}else{
echo $_POST['trans_id']; 
}
}
break;



case "Upload picture": 
$size = $_FILES['profile_img']['size'];
$file = $_FILES['profile_img']['name'];
$type = $_FILES['profile_img']['type'];        
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], "../upload/". $file )){
$updateImg = $conn->query("update customer_info set 
cust_photo = '$file' where customer_id = '" . $_POST['customer_id'] . "'") or die($conn->error);
echo 1;
}else{
echo "Could not upload file";
}
break;

case "Change Password": 
$ins = $conn->query("update customer_info set
pass = '" . $_POST['new_password'] . "' where customer_id = '" . $_POST['customer_id']. "'") or die($conn->error);
       
header("location:change-password?msg=Password Change Successfully");
break;
        

        
case "Off Otp": 
$stat = "Off";
$ins = $conn->query("update customer_info set otp_status = '$stat' where customer_id = '" . $_POST['customer_id']. "'") or die($conn->error);
header("location:2Authentication?msg=Otp is  successfully set as OFF");
break;  
        
    
    
    
case "On Otp":        
$stat = "On";
$ins = $conn->query("update customer_info set otp_status = '$stat' where customer_id = '" . $_POST['customer_id']. "'") or die($conn->error);
header("location:2Authentication?msg=Otp is successfully set as ON");
break;          
        
}
?>