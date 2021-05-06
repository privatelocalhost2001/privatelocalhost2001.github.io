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
                   <h3> Buble Your Internet Banking Login Security</h3>
                <div>
                         
   

<!--grey panel with contents starts-->
    <div class="row small-padding">
        <div class="twelve medium-12 small-12  columns grey-bggrey panel shadow curve" style="padding: 30px;">
            <div class="row" style="margin-top: 0px;">
                <div class="six columns" style="margin-top: 5px;">
                    <div class=" paddedm curve">
                       Click On to Activate Email OTP Login  
                    </div>
                </div>


                <div class="six columns" style="margin-top: 5px;">
                    <div class=" paddedm curve">
                        Check All Folder Of Your Email For Otp
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 0px;">
                <div class="six columns" style="margin-top: 10px;">
                    <div class=" paddedm curve">
                        Otp Last For Just 1 Hours if not use.  
                    </div>
                </div>


                <div class="six columns" style="margin-top: 10px;">
                    <div class=" paddedm curve">
                       Do Not Share Otp With  AnyOne
                    </div>
                </div>
            </div>
            </div>
            
            
            
              
                
                
                <form method="post" action="LOG-IN-OUT" enctype="multipart/form-data">
                        <?php
				  $seLInfo = $conn->query("select * from customer_info where  customer_id = '" . $rowUser['customer_id'] . "'") or die($conn->error);
                  $rowInfo = $seLInfo->fetch_array();
				
				  ?>
                
                      <table>
                          <span>
        <?php
						  if(isset($_GET['msg'])){
						  echo "<div class='twelve columns red-grad2'>" . $_GET['msg']. "</div>";
						  }
						  ?></span>
                          <tr>
                  <td height="9" colspan="2">
                  
                  <span type="submit" class="btn btn-warning"  class="btn btn-green col-lg-11">2F Athetification  is <?php echo $rowInfo['otp_status']; ?></span></td>
                  </tr>
                          
      
                          
                          <tr>
                  <td height="9" colspan="7">
                  <input name="customer_id" type="hidden" class="form-control" value="<?php echo $rowInfo['customer_id']; ?>" size="30" />
                  <button type="submit" id="onbutton"  <?php if($rowInfo['otp_status']== "On") {?> disabled="disabled" <?php } ?>  name="action" value="On Otp" class="btn btn-warning-on" onclick="return changepassword()" class="btn btn-green col-lg-11">On</button></td>
                  
                  <td height="9" colspan="2">
                  <input name="customer_id" type="hidden" class="form-control" value="<?php echo $rowInfo['customer_id']; ?>" size="30" />
                  <button type="submit" id="offbutton" <?php if($rowInfo['otp_status']== "Off") {?> disabled="disabled" <?php } ?> name="action" value="Off Otp" class="btn btn-warning-off" onclick="return changepassword()" class="btn btn-green col-lg-11">Off</button></td>
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
              </div>
           
    </div>
      <!-- . FOOTER  -->
        
          <?php include('../includes/footer.php');?>

                
                
 