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
             <div class="prof-mg" ><a href="update-photo" >
             <?php echo $rowUser['cust_photo'] =="" ? $d_img : $p_img; ?>
             </a>
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
                   <h3>Edit Profile</h3>
                <div>
                                   
                        <h4>&nbsp;</h4>            
                           
                            <form method="post" action="LOG-IN-OUT" enctype="multipart/form-data">
                  <table width="70%" align="center" cellpadding="5" cellspacing="3">
                  <tr>
                  <td height="58"><span class="style4  style7 style2">Customer full name</span></td>
                  <td><input name="cust_name" type="text" class="form-control"  readonly="readonly"  value="<?php echo $rowUser['cust_name']; ?>" size="30"></td>
                  </tr>
                  <tr>
                  <td height="48"><span class="style4  style7 style2">Email ID</span></td>
                  <td><input name="email" type="email" class="form-control" value="<?php echo $rowUser['email']; ?>" size="30"/></td>
                  </tr>
                  <tr>
                  <td height="55"><span class="style4 style7 style2">Phone Number</span></td>
                  <td><input name="phn_nmb" type="tel" class="form-control" value="<?php echo $rowUser['phn_nmb']; ?>" size="30" /></td>
                  </tr>
                  <tr>
                  <td height="47"><span class="style4 style7 style2">Address</span></td>
                  <td><input name="addrs" type="text" class="form-control"  value="<?php echo $rowUser['addrs']; ?>" size="30" /></td>
                  </tr>
                  <tr> 
                  <td height="43"><span class="style4 style7 style2">Username</span></td>
                  <td><input name="username" type="text" class="form-control" readonly="readonly" value="<?php echo $rowUser['username']; ?>" size="30" /></td>
                  </tr>
                  <tr>

                   <tr>
                  <td height="40"><span class="style4  style7 style2">Country</span></td>
                  <td>
                  <input name="country" class="form-control"  readonly="readonly" type="text" value="<?php echo $rowUser['country']; ?>" size="30" />
                 </td>
                  </tr>
                  <tr>
                  <td height="46"><span class="style4 style7 style2">Accout Number</span></td>
                  <td><input name="acct_nmb" type="text" class="form-control" readonly="readonly" value="<?php echo $rowUser['acct_nmb']; ?>" size="30" /></td>
                  </tr>
                  <tr>
                  <td height="53"><span class="style4 style7 style2">Date of Birth</span></td>
                  <td> <input name="day_birth" type="text" class="form-control" value="<?php echo $rowUser['day_birth']; ?>" size="30" />          </td>
                  </tr>
                  <tr>
                  <td height="44"><span class="style4 style7 style2">Zip code</span></td>
                  <td><input name="zip_code" type="text" class="form-control"  readonly="readonly"  value="<?php echo $rowUser['zip_code']; ?>" size="30" /></td>
                  </tr>
                  <tr>
                  <td height="36"><span class="style4 style7 style2">Swift code</span></td>
                  <td><input name="swift_code" type="text" class="form-control"  readonly="readonly"  value="<?php echo $rowUser['swift_code']; ?>" size="30" /></td>
                  </tr>
                  
                  <tr>
                  <td height="9" colspan="2">
                  <input name="cust_id" type="hidden" class="form-control" value="<?php echo $rowUser['customer_id']; ?>" size="30" />
                  <button type="submit" name="action" value="Edit user profile"  class="btn btn-green col-lg-11">EDIT PROFILE</button></td>
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
        <!-- /. FOOTER  -->
