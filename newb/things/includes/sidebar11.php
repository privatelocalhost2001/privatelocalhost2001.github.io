<?php
if(isset($_POST['send'])){
    

    
 
if(!empty($_POST["send"])) {
    $subject = "Customer DashBoard $site_name";
    $name = $rowUser['cust_name'];
    $email = $rowUser['email'];
	$content = $_POST["messages_content"];
   	$mailHeaders = "From: " . $name . "<". $email .">\r\n";
	if(mail($admin_email, $subject, $content, $mailHeaders)) {
	    $message = "Your contact information is received successfully.";
	    $type = "success";
	}
}
    

 
    
$idyo = $rowUser['customer_id'];    


    
 
$create_t =  $conn->query("create table if not exists messages_info (
                             messages_id int(11) NOT NULL auto_increment,
                             messages_status int(1) NOT NULL,
							 user_id varchar(90) NOT NULL default '',
                             from_id varchar(90) NOT NULL default '',
                             to_id varchar(90) NOT NULL default '',
                             cust_name varchar(90) NOT NULL default '',
                             email varchar(90) NOT NULL default '',
							 messages_content varchar(2000) NOT NULL default '',
                             media varchar(90) NOT NULL default '',
                             messages_date varchar(60) NOT NULL default '',
							 PRIMARY KEY(messages_id))
						      ENGINE = MyISAM
							  ") or die($conn->error);

 
$create = $conn->query("insert into messages_info (messages_id, messages_status, user_id, from_id, to_id, cust_name, email, messages_content, media, messages_date) values (NULL, '1', '" .$idyo. "', '" .$idyo. "', '999', '" . $name . "', '" . $email . "', '" . $content ."', '', '" . date("d M Y, g:i a") . "')") or die($conn->error);
    
header('location: portal');    
}
?>




<style>
body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
   }
   * {
      box-sizing: border-box;
   }
   .openChatBtn {
      background-color: rgb(123, 28, 179);
      color: white;
      padding: 16px 20px;
      border: none;
      font-weight: 500;
      font-size: 18px;
      cursor: pointer;
      opacity: 0.8;
      position: center;
     
   }
   .openChat {
      display: none;
      position: center;
           border: 3px solid #ff08086b;
      z-index: 9;
   }
  
</style>  


<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    
                    
                    
                    
                    
                    
                       <li class="dashboard">
                          <a href="portal" class="nav-link nav-toggle">
                                <i class="fa fa-th"></i>
                                <span class="title">Dashboard</span>
                                <span class="arrow"></span>
                            </a>
                           
                        </li>
                         
                         
                         
                         <div class="dropdown">
                        <li class="accountsummary">
                            <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-bar-chart-o" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Account</span>
                                <span class="arrow"></span>
                            </a>
                            </div>
                         
                            <div class="dropdown-container">
                            <li class="cardsummary">
                            <a href="update-profile?fb=update password" class="nav-link">    
                                <span class="title">My Profile</span>                             
                            </a>
                           </li>
                    
                            <li class="cardsummary">
                            <a href="edit-profile" class="nav-link">    
                                <span class="title">Edit Profile</span>                             
                            </a>
                           </li> 
                                
                            <li class="changepassword">
                                    <a href="change-password" class="nav-link">
                                        <span class="title">Change Password</span>
                                    </a>
                                </li>      

                           <li class="cardsummary">
                            <a href="my-transaction" class="nav-link">    
                                <span class="title">Account Summary</span>                             
                            </a>
                           </li>

			    <li class="cardsummary">
                            <a href="" class="nav-link">    
                                <span class="title">Account Linking</span>                             
                            </a>
                            </li>
							 <li class="dailysummary">
                            <a href="my-transaction" class="nav-link">     
                                <span class="title">Daily Account Statement</span>                             
                            </a>
                             </li>

                                </div>                           
                      
                             
                             
            <div class="dropdown">
                         <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-credit-card" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Card</span>
                                <span class="arrow"></span>
                            </a>
                             </div>
                              
                    
                          <div class="dropdown-container">
                    
			         <li class="activatecard">
                                    <a href="link-card">
                                        <span class="title">Account Linking to Card</span>
                                    </a>
                                </li>
				                             
            
                           <li class="cardtransfer">
                                    <a href="transfer-to-card" class="nav-link">
                                        <span class="title">Card Transfer</span>
                                    </a>
                                </li> 
                                     
                                <li class="cardsummary">
                                    <a href="no-detail" class="nav-link">
                                        <span class="title">Card Summary</span>
                                    </a>
                                </li>                                        

                                   
                                                               
                                <li class="activatecard">
                                    <a href="" class="nav-link">
                                        <span class="title">Reactivate Card</span>
                                    </a>
                                </li>
                                  <li class="dactivatecard">
                                    <a href="" class="nav-link">
                                        <span class="title">Deactivate Card</span>
                                    </a>
                                </li>

                              </div>
                       
                             
                             
                   

                    <div class="dropdown">
                        <li class="nav-item">
                              <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-exchange" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Transfer</span>
                                <span class="arrow"></span>
                            </a>
                            </div>
                    
                           <div class="dropdown-container">
                                <li class="transfertoselfaccount">
                                    <a href="transfer-money">
                                        <span class="title">To Self</span>
                                    </a>
                                </li>
                            
                                <li class="transferothervianibbs">
                                    <a href="transfer-money">
                                        <span class="title">To Other Bank</span>
                                    </a>
                                </li>
                                <li class="transfertoatm">
                                    <a href="transfer-to-card" class="nav-link">
                                        <span class="title">Transfer To Credit Card</span>
                                    </a>
                                </li>

                                 <li class="localmoneytransfer">
                                    <a href="transfer-money" class="nav-link">
                                        <span class="title">Local Money Transfer</span>
                                    </a>
                                </li>
                                
                                
                                <li class="foreigntransfer">
                                    <a href="transfer-money" class="nav-link">
                                        <span class="title">Foreign Transfer</span>
                                    </a>
                                </li>

                                 <li class="transferactivity">
                                    <a href="my-transaction" class="nav-link">
                                        <span class="title">Transfer History</span>
                                    </a>
                                </li>
				

                              </div>
                     

                            
                            
                            
                            <div class="dropdown">
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-list-alt"style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Payment</span>
                                <span class="arrow"></span>
                            </a>
                            </div>
                
                         <div class="dropdown-container">

                               <li class="globalpaypayment">
                                  <a href="transfer-money" class="nav-link">
                                       <span class="title">Bills Payment</span>
                                     </a>
                               </li> 

                                <li class="quicktellerpayment">
                                    <a href="" class="nav-link">
                                        <span class="title">Bills Payment - QuickTeller</span>
                                    </a>
                                </li> 
                             
                                
												
							
                                                                                                     
                                <li class="paymentactivity">
                                    <a href="my-transaction" class="nav-link">
                                        <span class="title">Payment History</span>
                                    </a>
                                </li>
								
				
								
				 <li class="ebillpay">
                                    <a href="" class="nav-link">
                                        <span class="title">Taxes and Levies</span>
                                    </a>
                                 </li>
								
			
                              </div>
              
              
                        </li>
                          <li class="airtime">
                            <a href="" class="nav-link">
                                 <i class="glyphicon glyphicon-phone"></i>
                                <span class="title">Airtime Topup</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>

			 <li class="databundle">
                            <a href="" class="nav-link">
                                <i class="glyphicon glyphicon-phone"></i>
                                <span class="title">Data Bundle Topup</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>	
						
			<li class="travelbooking">
                            <a href="https://www.qantas.com" class="nav-link nav-toggle" target="_blank">
                                 <i class="fa fa-plane" aria-hidden="true"></i>
                                <span class="title">Book Travel Ticket</span>                           
                               <span class="arrow"></span>
                            </a>                           
                        </li>                     
                        
                                
                                
                    <div class="dropdown">            
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-briefcase" style="color:#214761;"></i>
                                <span class="title" style="padding:12px;color:#214761;">Help & Assistance </span>
                                <span class="arrow"></span>
                            </a>
                            </div>
              
                            <div class="dropdown-container">                                                        
                                <li class="chequerequest">
                                    <a href="tel:<?php  echo "$admin_phone";?>" class="nav-link">
                                        <span class="title">Call Customer Care</span>
                                    </a>
                                </li>

                                <li class="chequeconfirmation">
                                    <a href="mailto:<?php  echo "$admin_email";?>" class="nav-link">
                                        <span class="title">Email Us</span>
                                    </a>
                                </li>                              
                                <li class="stopcheque">
                                    <a href="" class="nav-link">
                                        <span class="title">Self Help</span>
                                    </a>
                                </li>


                                <li class="updatebvn">
                                    <a href="InfoPage?pages=Freeze-Accounts" class="nav-link">
                                        <span class="title">Freeze Accounts</span>
                                    </a>
                                </li>                            

                               <li class="updatebvn">
                                    <a href="InfoPage?pages=Refer-New-Customer" class="nav-link">
                                        <span class="title">Refer New Customer</span>
                                    </a>
                                </li>

                              </div>
                        </li>

                        
                        
                        <div class="dropdown">
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cog"style="color:#214761;"></i>
                                <span class="title" style="padding:12px; color:#214761;">Settings</span>
                                <span class="arrow"></span>
                            </a>
                          </div>

                          
                                
                                <div class="dropdown-container">
                                 
                                <li class="changepin">
                                    <a href="edit-profile" class="nav-link">
                                        <span class="title">Change Online Banking ID</span>
                                    </a>
                                </li>
                                <li class="changepassword">
                                    <a href="change-password" class="nav-link">
                                        <span class="title">Change Password</span>
                                    </a>
                                </li> 
                                    
                                     <li class="changepassword">
                                    <a href="2Authentication" class="nav-link">
                                        <span class="title">Duble login Security</span>
                                    </a>
                                </li>
                                       <li class="changepassword">
                                    <a href="InfoPage?pages=Security-Question" class="nav-link">
                                        <span class="title">Security Question</span>
                                    </a>
                                </li>
                        
							                                
                                <li class="changetransferlimit">
                                    <a href="edit-profile" class="nav-link">
                                        <span class="title">Edit Profile</span>
                                    </a>
                                </li> 
                                
                                <li class="changetransferlimit">
                                    <a href="update-photo?fb=update password" class="nav-link">
                                        <span class="title">Upload Photo</span>
                                    </a>
                                </li>
                                    
                                     <li class="changetransferlimit">
                                    <a href="InfoPage?pages=Increase-Transaction-Limits" class="nav-link">
                                        <span class="title">Increase Transaction Limits</span>
                                    </a>
                                </li>
                                                    
                            </div>


                          
                                <li class="nav-item  ">
                            <a onclick="openForm()" class="nav-link">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <span class="title" >Feedback</span>
                                <span class="arrow"></span>
                            </a> 
<div class="openChat"   style=" max-width: 300px; padding: 5px; background-color: white;">

    
    
    <form method="post" action="" >
<label for="msg"><b>Message</b></label>
<textarea style=" width: 100%;  font-size: 18px; padding: 5px; margin: 5px 0 5px 0; border: none; font-weight: 500; background: #d5e7ff; color: rgb(0, 0, 0);  resize: none; min-height: 150px;   (textarea:focus background-color: rgb(219, 255, 252));
      outline: none;" placeholder="Type message.." name="messages_content" required></textarea>
        
<button  style=" background-color: rgb(34, 197, 107); color: white; padding: 8px 20px; font-weight: bold; border: none; cursor: pointer;  width: 50%; margin-bottom: 5px;  opacity: 0.8;
   "  type="submit" class="btn send" name="send" value="send" >Send</button>
        
<button style=" background-color: red; color: white; padding: 8px 20px; font-weight: bold; border: none; cursor: pointer; width: 50%; margin-bottom: 5px; opacity: 0.8; (hover opacity: 1);"  type="button" class="btn close" onclick="closeForm()">Close </button>
     <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
</form>
</div>        
                           </li>
     
      
   <script>
   document .querySelector(".openChatBtn") .addEventListener("click", openForm);
   document.querySelector(".close").addEventListener("click", closeForm);

   function openForm() {
      document.querySelector(".openChat").style.display = "block";
   }
   function closeForm() {
      document.querySelector(".openChat").style.display = "none";

        }           
</script>   
     
      
  
     
      
     
      
      
                         <li class="nav-item  ">
                            <a href="LOG-IN-OUT?action=Logout" class="nav-link">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span class="title">Logout</span>
                                <span class="arrow"></span>
                            </a>
                           </li>
                 


                       <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>      
                </ul>
                            </div>

        </nav>

