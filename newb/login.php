  
                <script src="js.js"></script>


                <form  id="loginform" class="loginform">
                    
                      <label >Login ID</label>
                        <div >
                            <input class="form-control" type="text"  id="account" name="account" style="color: #E4E4E4;" > 
                        </div>
                   
                      <label >Password</label>
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  id="passwrd" name="passwrd" style="color: #E4E4E4;" > 
                        </div>
                 
      
                <div class="forminfo"></div>
 
                    <div class="col-xs-12">
                    <button  type="submit">Submit</button>
                    </div>
                
                        <div>
                            <p >Forget Login Details? <a href="forgetPasswordEmail" ><b>Reset</b></a></p>
                        </div>
                </form>
 
    
    
    



    
    
    <script src="things/js/jquery-1.10.2.js"></script>

       
    
 <script type="text/javascript">
$(document).ready(function(){   
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

 })
</script>
   













