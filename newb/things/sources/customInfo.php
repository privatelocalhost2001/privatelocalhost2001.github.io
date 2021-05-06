<?php
$selMem = $conn->query("select * from customer_info where customer_id = '"  . $_SESSION['user_id'] . "'") or die($conn->error);
$rowUser = $selMem->fetch_assoc();


$selcurr = $conn->query("select * from curr_type where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
$rowcurr = $selcurr->fetch_assoc();

function getCurrency($currType){
switch($currType){
case "Dollar":
$cur_d = "$";
break;
case "Pounds":
$cur_d = "&#163;";
break;
case "Yen":
$cur_d = "&yen;";
break;
case "Euro":
$cur_d = "&euro;";
break;
case "Swiss franc":
$cur_d = "CHF";
break;        
case "Polish zloty":
$cur_d = "zł";
break;
case "Czech koruna":
$cur_d = "Kč";
break; 
case "Malaysia Ringgit":
$cur_d = "MR";
break;
case "NGR":
$cur_d = "&#8358;";
break;        
case "Namibia Dollar":
$cur_d = "N$";        
break;
case "ZAR":
$cur_d = "ZAR";
break;
case "Rand":
$cur_d = "Rand";        
break;
default:
$cur_d = "$";
break;
}
return $cur_d;
}


if(!isset($_SESSION['user_id'])){
header("location: home");
}
?>


