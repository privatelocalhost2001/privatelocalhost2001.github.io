
<div class="footer" >
      
    
            <div class="row" >
                <div class="col-lg-12" >
                    <div class="page-footer-inner" > <?php echo date("Y"); ?> © Internet Banking.
        <a href="<?php echo "$site_url";?>" title="" target="_blank"><span><?php  echo "$site_name";?></span></a>
                          
                        
           
                        
                        
                        

       </div>
                </div>
            </div>
        </div>
         

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="things/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="things/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="things/js/custom.js"></script>
    <!-- CUSTOM TEST NAME AND INFO  SCRIPTS -->
    <script type="text/javascript" src="things/js/bank/script.js" ></script>


 
	<!--For Time Out Pop Up-->
	 <div class="popup" data-popup="popup-exp">
            <div class="popup-inner-small">

                <div style="width: 100%; background: #ffffff url(&#39;things/img/timeout-icon.jpg&#39;) no-repeat 10px 10px;">
                    <hr>
                    <div style="margin-left: 60px; line-height: 17px; height: 30px;">
                        <b id="session-notification"></b>
                    </div>
                    <hr>
                    <div id="session-not">
                        <a id="" href="LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>

                        <a id="" href="" style="float: right;"><i class="fa fa-sign-in"></i>&nbsp;Continue</a>
                    </div>
                    <div id="session-exp">
                        <a id="" href="home"><i class="fa fa-sign-out"></i>&nbsp;Click here</a>
                        to Login
                    </div>
                </div>
            </div>
        </div>
      
 
    
	 <script>
        // Set the date we're counting down to
        var countDownDate = new Date();
        var sessionTimeout = 6;
        countDownDate.setMinutes(countDownDate.getMinutes() + sessionTimeout);


        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate.getTime() - now;

            // Time calculations for days, hours, minutes and seconds    

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="CountDown"
            if (minutes < 2) {
                //window.setTimeout(function () {
                //    var targeted_popup_class = 'divTimeout-Pop';
                //    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
                //}, 1000);
                //document.getElementById("CountDown").innerHTML = "Your Session will timeout In " + minutes + "m " + seconds + "s Due To Inactivity.";

                var targeted_popup_class = 'popup-exp';
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
                $('#session-not').fadeIn();
                $('#session-exp').fadeOut();
                document.getElementById("session-notification").innerHTML = "Your session will timeout in <b style=color:red;>" + minutes + "m " + seconds + "s</b> due to inactivity.";
            }

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                // document.getElementById("CountDown").innerHTML = "Your Session has timed out due to inactiviy, Please login again.";
                document.getElementById("session-notification").innerHTML = "Sorry, your session has expired due to inactivity.";
                $('#session-not').fadeOut();
                $('#session-exp').fadeIn();
                var user_logout = (window.location= "LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>") ;
                
            }
        }, 1000);
    </script>  





   <script type='text/javascript'>

    function Logoutfunction() {
var user_choice = window.confirm('Would you like to continue?  This will log you off from  <?php echo "$site_name" ?> online banking');
if(user_choice==true) {
window.location='LOG-IN-OUT?action=Logout&id=<?php echo $rowUser['customer_id']; ?>'; 
} else {
    
return false;
    
}
}
</script> 

   
</body>
</html>