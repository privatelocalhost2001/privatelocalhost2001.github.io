<?php 
session_start();
include('../includes/conn_auth.php');
include('../includes/customInfo.php');
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
                
                
   
   
     
                
                
                  <section id="team">
      <div class="container" style="width:90%;">
        <div class="section-header">
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="col-lg-12">
                        <div class="pInfo">
                         
                   <div class="transT">
                   
               <hr>
               <h3 class="style10">This function is not available for you</h3>
                
                 </div> </div> </div> </div> </div>
                
                
                
                
                
                
                
                
                
                
    
                
                
                
                
                
                


                  </div>
              </div>
           
    </div>
         
   <!-- . FOOTER  -->
                 <?php include('../includes/footer.php');?>
        
      
  