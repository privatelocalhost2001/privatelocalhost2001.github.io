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
      <div class="container">
        <div class="section-header">
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="portfolio-page">

   <?php				
				 $selTrans = $conn->query("select * from credit_info  where accnt_nmb = '" . $rowUser['acct_nmb'] . "'") or die($conn->error);
				 $rowTrans = $selTrans->fetch_assoc();
				 ?> 
                
  <div class="col-lg-12">
                        <div class="pInfo">
                       <div class="transT">
                   <h3>Edit Photo</h3>
                <div>
     <script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
  document.getElementById('img_data').style.display="none";
 }
 reader.readAsDataURL(event.target.files[0]);
}

</script>             
                                   
                        <h4>&nbsp;</h4>           
                       <div class="errorInfo alert alert-danger" style="display:none;"></div>
					   <?php  
                     $d_img=  "<img src='things/img/blank-profile-picture.png' id='prof-img' class='prof-img' style='width:150px; hieght:150px;' >";
					 $p_img=  "<img src='things/upload/". $rowUser['cust_photo']. "' id='prof-photo' class='prof-photo' style='width:150px; hieght:150px;' />"; 
					 ?>
					  <form method="post" action="login.php"  id="formUpload" enctype="multipart/form-data" >
                   <div class="col-md-12" id="uploadForm"> 
                   <div class="col-md-5 col-xs-offset-3">
                   <div id="img_data">
                   <?php echo $rowUser['cust_photo']== "" ? $d_img : $p_img; ?>
                   </div>
                   <img id="output_image"/>
                    </div>
                 </div>
                  <div class="col-md-12 subBox">
                   <div class="col-md-5 col-xs-offset-3">
                   <div id="wrapper">
                <input type="file" name="profile_img" accept="image/*" id="up_img" onChange="preview_image(event)">
                  <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $rowUser['customer_id']; ?>">
                    </div>
                       </div>
                   </div>
                  <div class="col-md-12 subBox">
                   <div class="col-md-5 col-xs-offset-2">
                   <button type="submit" value="Upload Picture" name="action" class="btn btn-info col-xs-16 btn-lg btnUpload">Continue</button>
                   </div>
                   </div>
                  
                   </form>
                              </div>
                </div>
                
              </div>
                    
                    </div>
  </div>
          </div>

      
 </div> </div>
                

 

                  </div>
              </div>
           
    </div>
         
     <!-- . FOOTER  -->
        
    <?php include('../includes/footer.php');?>
