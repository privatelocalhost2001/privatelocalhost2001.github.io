<?php 
session_start();
include('../sources/conn_auth.php');
include('../sources/customInfo.php');
?>
  <!-- /. NAV TOP  -->
        <!-- . SIDENAV  -->
    <?php include('../includes/head.php');?>
    <?php include('../includes/sidebar.php');?>
        <!-- /. SIDENAV  -->
    
   
			
        
    
     <?php
				 
				 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
				 $rowTrans = $selTrans->fetch_assoc();
				 ?> 


    
<?php
				  $seLInfo = $conn->query("select * from customer_info where  customer_id = '" . $rowUser['customer_id'] . "'") or die($conn->error);
                  $rowInfo = $seLInfo->fetch_array();
				
				  ?>


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                       
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
                
            
                
               <?php include('../includes/account_info.php');?> 
            
                
             
                       
            <div class="section"> 
                
                
   
   
     
     
    <!--==========================
      Our Team Section
    ============================-->
    <section id="team">
      <div class="container"style="width:90%;">
                
                
                
                 <?php 
				$d_img=  "<img src='things/img/blank-profile-picture.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
				$p_img=  "<img src='things/upload/". $rowUser['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					  
		      ?>
            <div class="sideBar" >
             <div class="prof-mg" >
             <?php echo $rowUser['cust_photo'] =="" ? $d_img : $p_img; ?>
             
             <span class="acc-st">
    <a href="update-profile?fb=update password"> <i class="fa fa-user"></i>  My profile </a>
             </span>
             </div>
      
     
     
   <?php
				 
				 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
				 $rowTrans = $selTrans->fetch_assoc();
				 ?> 
                
  <div class="col-lg-12">
                        <div class="pInfo">
                       <div class="transT">
                   <h3>Change Your Internet Banking Password</h3>
                <div>
                         
                  
                    
                    
                    <div class="twelve medium-12 small-12  columns grey-bggrey panel shadow curve" style="padding: 30px;">
            <div class="row" style="margin-top: 0px;">
                <div class="six columns" style="margin-top: 5px;">
                    <div class=" paddedm curve">
                        Password can not be the same things as your user ID. 
                    </div>
                </div>


            </div>
            <div class="row" style="margin-top: 0px;">
                <div class="six columns" style="margin-top: 10px;">
                    <div class=" paddedm curve">
                        Password must be a minimum of 6 characters.  
                    </div>
                </div>


                <div class="six columns" style="margin-top: 10px;">
                    <div class=" paddedm curve">
                        Your Password must be alphanumeric.
                    </div>
                </div>
            </div>
                        </div>
                    
                    
                    
                    
                     <div>
               <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='alert alert-info'>" . $_GET['msg']. "</div>";
						  }
						  ?>
                </div>
                    
                        <h4>&nbsp;</h4>            
                           
                            <form method="post" action="LOG-IN-OUT" enctype="multipart/form-data">
                  <table width="70%" align="center" cellpadding="5" cellspacing="3">
                  <tr>
                  <td height="58"><span class="style4  style7 style2">Old Password</span></td>
                  <td><input  name="pass" type="text" class="form-control" readonly="" value="<?php echo $rowUser['pass']; ?>" size="30"></td>
                  </tr>
                  <tr>
                  <td height="48"><span class="style4  style7 style2">Enter New Password</span></td>
                  <td><input id="passnew" name="new_password" type="text" class="form-control" value="" size="30"/></td>
                  </tr>
              
                     <tr>
                  <td height="48"><span class="style4  style7 style2">Re-Enter New Password</span></td>
                  <td><input  id="conpassnew"  name="comfirm_new_password"  type="text" class="form-control" value="" size="30"/>
                         <td colspan="2"> <div class="btnCh"></div></td>
                         </td>
                  </tr>
                      
       
                    
                    <?php
				  $seLInfo = $conn->query("select * from customer_info where  customer_id = '" . $rowUser['customer_id'] . "'") or die($conn->error);
                  $rowInfo = $seLInfo->fetch_array();
				
				  ?>
                    
                  
                  <tr>
                  <td height="9" colspan="2">
                  <input name="customer_id" type="hidden" class="form-control" value="<?php echo $rowUser['customer_id']; ?>" size="30" />
                  <button type="submit" name="action" value="Change Password" class="btn btn-warning" onclick="return changepassword()" class="btn btn-green col-lg-11">Change Password</button></td>
                  </tr>
                    
                    
                    
                    
                    
                  </table>
                  </form>
                                      
                                   
                              </div>
      
      
      
      
      
      
      
      
      
      
      
      
                </div>
                        </div>
                    
                    </div>
  </div>
          </div>

      
         

      </div>




                               
                

      </div>
                       </div>
  
 
 

                  </div>
              </div>
           
    </div>
      <!-- . FOOTER  -->
        
          <?php include('../includes/footer.php');?>
 